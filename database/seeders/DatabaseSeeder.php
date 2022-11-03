<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Status;
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
        // \App\Models\User::factory(10)->create();

        Status::create(['status_name' => 'Penawaran']);
        Status::create(['status_name' => 'Demo']);
        Status::create(['status_name' => 'Follow Up']);
        Status::create(['status_name' => 'Go']);
    }
}
