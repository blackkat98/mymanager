<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('media_files')->insert([
            'ownable_type' => 'App\Models\User',
            'ownable_id' => 1,
            'media_type' => 'image',
            'path' => 'img/user.png',
        ]);

        DB::table('media_files')->insert([
            'ownable_type' => 'App\Models\User',
            'ownable_id' => 2,
            'media_type' => 'image',
            'path' => 'img/user.png',
        ]);
    }
}
