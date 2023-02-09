<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::withoutEvents(function () {
            $users = User::all();

            foreach ($users as $user) {
                if (!$user->userProfile) {
                    $user->userProfile()->create();
//                    UserProfile::updateOrCreate(
//                        ['user_id' => $user->key]
//                    );
                }
            }

            return true;
        });
    }
}
