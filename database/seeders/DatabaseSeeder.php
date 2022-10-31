<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        $user = User::createAdmin($password = Str::random(8));

        $this->call(CategorySeeder::class);

        dump("Admin created with Credentials: " . $user->email . "/" .  $password);
    }
}
