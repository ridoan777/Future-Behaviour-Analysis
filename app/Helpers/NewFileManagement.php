<?php
namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\{Log, Storage};
use Throwable;

class NewFileManagement
{
	private static $modifiedFileName = '';
	private static $DBFriendlyFileName = '';

	// --------------------------------------
	public static function handleFile($fileInput, $title, $oldFile = null, $folder, $disk = null, $remove = false)
	{
		$activeDisk = $disk ?? config('filesystems.default');

		if ($remove && $oldFile && Storage::disk($activeDisk)->exists($oldFile)) {
			Storage::disk($activeDisk)->delete($oldFile);
			return null;
		}

		if ($fileInput) {
			if ($oldFile) {
				$exists = Storage::disk($activeDisk)->exists($oldFile);

				if ($exists) {
					Storage::disk($activeDisk)->delete($oldFile);
				}
			}

			$newPath = self::storeFile($fileInput, $title, $folder, $activeDisk);
			return $newPath;
		}

		return $oldFile;
	}

	// --------------------------------------
	public static function storeFile($file, $title, $folder, $disk = null): string
	{
		$activeDisk = $disk ?? config('filesystems.default');
		$originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
		$fileExtension = $file->getClientOriginalExtension();
		$titlePart = $title ? substr(self::sanitizeForFilename($title), 0, 9) : 'no_title';
		$namePart = substr(self::sanitizeForFilename($originalName), 0, 9);
		self::$modifiedFileName = "{$namePart}_{$titlePart}_" . uniqid() . ".{$fileExtension}";
		$file->storeAs($folder, self::$modifiedFileName, $activeDisk);
		self::$DBFriendlyFileName = "{$folder}/" . self::$modifiedFileName;
		return self::$DBFriendlyFileName;
	}

	// --------------------------------------
	private static function sanitizeForFilename(string $input): string
	{
		return trim(preg_replace('/[^A-Za-z0-9\-_]/', '_', $input), '_');
	}

	// --------------------------------------
	public static function deleteFile(?string $oldFilePath, string $disk = null): bool
	{
		$activeDisk = $disk ?? config('filesystems.default');
		if ($oldFilePath && Storage::disk($activeDisk)->exists($oldFilePath)) {
			Storage::disk($activeDisk)->delete($oldFilePath);
			return true;
		}
		return false;
	}
	// ------------------------------------------------------------------------------------
	public static function deleteFolder(?string $folderPath, string $disk = 'public'): bool
	{
		if ($folderPath && Storage::disk($disk)->exists($folderPath)) {
			Storage::disk($disk)->deleteDirectory($folderPath);
			return true;
		}
		return false;
	}

	// --------------------------------------
	public static function getUrl(string $path): ?string
	{
		return $path ? Storage::url($path) : null;
	}

	// --------------------------------------
	public static function getDirectoryFreeName(): string
	{
		return self::$modifiedFileName;
	}

	// --------------------------------------
	public static function getNewFileName(): string
	{
		return self::$DBFriendlyFileName;
	}

	###################################################

	public static function videoDurationOld($filePath, $disk = null)
	{
		try {
			$activeDisk = $disk ?? config('filesystems.default');
			$getID3 = new \getID3;

			if ($activeDisk === 's3') {
				$tempFile = tempnam(sys_get_temp_dir(), 'video_');
				$stream = Storage::disk($activeDisk)->get($filePath);
				file_put_contents($tempFile, $stream);
				$absolutePath = $tempFile;
				Log::info("tempFile=", [$tempFile]);
			} else {
				$absolutePath = Storage::disk($activeDisk)->path($filePath);
				if (!file_exists($absolutePath)) {
					Log::warning('videoDuration: file not found on disk', [
						'lesson_video_path' => $filePath,
						'resolved_absolute' => $absolutePath,
					]);
					return 0;
				}
			}

			// ---------- TRY getID3 ----------
			$fileInfo = $getID3->analyze($absolutePath);

			if (!empty($fileInfo['playtime_seconds'])) {
				$duration = round(((float)$fileInfo['playtime_seconds']) / 60, 2);

				if ($activeDisk === 's3')
					unlink($absolutePath);

				Log::info('videoDuration', [
					'activeDisk' => $activeDisk,
					'absolutePath' => $absolutePath,
					'duration_minutes' => $duration,
					'playtime_seconds' => $fileInfo['playtime_seconds'] ?? null,
					'file_size' => $fileInfo['filesize'] ?? null,
				]);

				return $duration;
			}

			// ---------- FALLBACK: ffprobe ----------
			$cmd = "ffprobe -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 \"$absolutePath\"";
			exec($cmd, $output);

			Log::info('cmd', [
				'cmd' => $cmd,
				'absolutePath' => $absolutePath,
				'output' => $output,
				'playtime_seconds' => $fileInfo['playtime_seconds'] ?? null,
				'file_size' => $fileInfo['filesize'] ?? null,
			]);

			if ($activeDisk === 's3')
				unlink($absolutePath);

			if (!empty($output[0])) {
				return round(((float)$output[0]) / 60, 2);
			}

			return 0;

		} catch (Throwable $e) {
			Log::error('Video duration error: ' . $e->getMessage());
			return 0;
		}
	}

	public static function videoDuration($filePath, $disk = null)
	{
		try {
			$activeDisk = $disk ?? config('filesystems.default');

			if ($activeDisk === 's3') {
				$tempFile = tempnam(sys_get_temp_dir(), 'video_');
				$stream = Storage::disk($activeDisk)->get($filePath);
				file_put_contents($tempFile, $stream);
				$absolutePath = $tempFile;
			} else {
				$absolutePath = Storage::disk($activeDisk)->path($filePath);
				if (!file_exists($absolutePath)) {
					Log::warning('videoDuration: file not found on disk', [
						'lesson_video_path' => $filePath,
						'resolved_absolute' => $absolutePath,
					]);
					return 0;
				}
			}

			$ffprobeOutput = [];

			$ffprobeBin = env('FFPROBE_PATH', 'ffprobe');
			$cmd = "\"$ffprobeBin\" -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 \"$absolutePath\" 2>&1";
			exec($cmd, $ffprobeOutput);

			Log::info('videoDuration ffprobe result', [
				'filePath' => $filePath,
				'absolutePath' => $absolutePath,
				'ffprobe_output' => $ffprobeOutput,
			]);

			if (!empty($ffprobeOutput[0]) && is_numeric(trim($ffprobeOutput[0]))) {
				$duration = round(((float)trim($ffprobeOutput[0])) / 60, 2);
				if ($activeDisk === 's3')
					unlink($absolutePath);
				return $duration;
			}

			// -------------- FALLBACK: getID3 — only when ffprobe is unavailable --------------
			$getID3 = new \getID3;
			$fileInfo = $getID3->analyze($absolutePath);

			Log::info('videoDuration getID3 result', [
				'filePath' => $filePath,
				'playtime_seconds' => $fileInfo['playtime_seconds'] ?? null,
				'filesize' => $fileInfo['filesize'] ?? null,
			]);

			if (!empty($fileInfo['playtime_seconds'])) {
				$duration = round(((float)$fileInfo['playtime_seconds']) / 60, 2);
				if ($activeDisk === 's3')
					unlink($absolutePath);
				return $duration;
			}

			Log::warning('videoDuration: both ffprobe and getID3 failed', [
				'filePath' => $filePath,
			]);
			if ($activeDisk === 's3')
				unlink($absolutePath);
			return 0;

		} catch (Throwable $e) {
			Log::error('videoDuration exception: ' . $e->getMessage(), [
				'filePath' => $filePath,
			]);
			return 0;
		}
	}
}