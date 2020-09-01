<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $usersCount = DB::table('users')->count();

        if($usersCount !== 0){
            return;
        }

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        factory(App\Models\Users\User::class, 5)->create()->each(function ($user) {
            $user->save();
        });
    }
}
