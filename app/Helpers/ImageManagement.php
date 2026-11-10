<?php

namespace App\Helpers;

use Illuminate\Support\Facades\{Log, Storage};

class ImageManagement
{
	private static $modifiedFileName = '';
	private static $DBFirendlyFileName = '';

	// --------------------------------------
	public static function handleFile($fileInput, $title, $oldFile = null, $folder, $disk = 'public', $remove = false)
	{
		// If remove flag is true, delete old file
		if ($remove && $oldFile && Storage::disk($disk)->exists($oldFile)) {
			Storage::disk($disk)->delete($oldFile);
			return null;
		}

		// If new file uploaded
		if ($fileInput) {
			// Delete old file first
			if ($oldFile && Storage::disk($disk)->exists($oldFile)) {
				Storage::disk($disk)->delete($oldFile);
			}

			// Store new file
			return self::storeFile($fileInput, $title, $folder, $disk);
		}

		// No changes → return old file
		return $oldFile;
	}

	// --------------------------------------
	public static function storeFile($file, $title, $folder, $disk = 'public'): string
	{
		$originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
		$fileExtension = $file->getClientOriginalExtension();

		// Take first 9 chars of original filename (sanitized)
		$oldFilenamePartial = substr(self::sanitizeForFilename($originalName), 0, 9);

		// Clean up title
		if (!empty($title)) {
			$cleanTitle = strip_tags($title); // remove HTML
			$cleanTitle = self::sanitizeForFilename($cleanTitle);
			$postTitlePartial = substr($cleanTitle, 0, 9);
		} else {
			$postTitlePartial = "no_title";
		}

		// Generate final filename
		self::$modifiedFileName = "{$oldFilenamePartial}_{$postTitlePartial}_" . uniqid() . ".{$fileExtension}";

		$file->storeAs($folder, self::$modifiedFileName, $disk);

		self::$DBFirendlyFileName = $folder . '/' . self::$modifiedFileName;

		return self::$DBFirendlyFileName;
	}

	// --------------------------------------
	private static function sanitizeForFilename(string $input): string
	{
		$clean = preg_replace('/[^A-Za-z0-9\-_]/', '_', $input);
		return trim($clean, '_');
	}

	// --------------------------------------
	public static function getDirectoryFreeName(): string
	{
		return self::$modifiedFileName;
	}

	// --------------------------------------
	public static function getNewFileName(): string
	{
		return self::$DBFirendlyFileName;
	}

	// --------------------------------------
	public static function deleteFile(?string $oldFilePath, string $disk = 'public'): bool
	{
		if ($oldFilePath && Storage::disk($disk)->exists($oldFilePath)) {
			Storage::disk($disk)->delete($oldFilePath);
			return true;
		}
		return false;
	}
	// --------------------------------------
	public static function deleteFolder(?string $folderPath, string $disk = 'public'): bool
	{
		if ($folderPath && Storage::disk($disk)->exists($folderPath)) {
			Storage::disk($disk)->deleteDirectory($folderPath);
			return true;
		}
		return false;
	}

	###################################################
	public static function videoDuration($filePath)
	{
		if (!file_exists($filePath)) {
			return 0;
		}

		try {
			$getID3 = new \getID3;
			$fileInfo = $getID3->analyze($filePath);

			Log::info('Video analysis', [
				'file' => basename($filePath),
				'playtime_seconds' => $fileInfo['playtime_seconds'] ?? 'not found',
				'playtime_string' => $fileInfo['playtime_string'] ?? 'not found'
			]);

			if (!empty($fileInfo['playtime_seconds'])) {
				$durationInSeconds = (float)$fileInfo['playtime_seconds'];
				$minutes = round($durationInSeconds / 60);
				return $minutes;
			}

			return 0;
		} catch (\Exception $e) {
			Log::error('Video duration error: ' . $e->getMessage());
			return 0;
		}
	}


}
