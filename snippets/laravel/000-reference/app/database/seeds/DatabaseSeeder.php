<?php

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
        $this->call(UsersTableSeeder::class);
        $this->call(TicketStatusSeeder::class);
        $this->call(TicketsSeeder::class);
        $this->call(PackageTableSeeder::class);
    }
}
