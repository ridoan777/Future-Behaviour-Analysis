<?php

namespace Database\Seeders;

use App\Helpers\UidGenerator;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
	public function run(): void
	{
		$users = [
			['first_name' => 'Alpha', 'last_name' => 'Albert', 'role' => 'admin', 'email' => 'alpha@test.com'],
			['first_name' => 'Beta', 'last_name' => 'Burners', 'role' => 'admin', 'email' => 'beta@test.com'],

			['first_name' => 'Charlie', 'last_name' => 'Chapline', 'role' => 'enrolled', 'email' => 'charlie@test.com'],
		];

		foreach ($users as $index => $item) {

			User::updateOrCreate(
				[
					'email' => $item['email'],
				],
				[
					'user_uid' => UidGenerator::uniqueName($item['first_name'],12,4),

					'first_name' =>  $item['first_name'] ?? null,
					'last_name' =>  $item['last_name'] ?? null,

					'role' => $item['role'],
					'phone' => "+{$index}-123-4567",

					'password' => Hash::make('12345678'),

					'remember_token' => Str::random(10),
					'email_verified_at' => now(),

					'status' => 1
				]
			);
		}
	}
}