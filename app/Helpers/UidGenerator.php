<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class UidGenerator
{

	// ------------------------------------------------------------------------------------
	public static function uniqueName($userName, $nameLength=null, $randomLength=3): string
	{

		$oldNameSanitizedPartial = substr(self::sanitizeName($userName), 0, $nameLength);

      $generatedUid = now()->format('dmy') ."-". $oldNameSanitizedPartial . "-" . strtoupper(Str::random($randomLength));

		return $generatedUid;
	}

	// ------------------------------------------------------------------------------------
	public static function sanitizeName(string $input): string
	{
		$clean = preg_replace('/[^A-Za-z0-9\-\_\[\]\(\)]/', '_', $input);
      // Replace every character that is not A–Z, a–z, 0–9, -, _, [, ], (, or ) with _ (underscore)
		return trim($clean, '_');
}

}