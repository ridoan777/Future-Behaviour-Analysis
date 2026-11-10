<?php

namespace App\Helpers;

use App\Helpers\ApiJsonReturnHelper;
use App\Helpers\ExceptionHandling;
use App\Models\Users\User;

class OwnershipAuthCheck
{
	// --------------------------------------
	public static function ownerVsOwner(int $creatorId, int $claimantId)
	{
		if ((int) ($creatorId) !== (int) ($claimantId)) {
			ExceptionHandling::bailout(403, "Unauthorized! You are not the owner of this section/content");
		}
		return true;
	}

	// --------------------------------------

}
/*
This helper checks if the respective content is owned by the requested user. Just call it as follows. No if-else is needed.
	OwnershipAuthCheck::ownerVsOwner($creator, $user->id);
*/