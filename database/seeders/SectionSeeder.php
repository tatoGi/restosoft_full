<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            'id' => 1,
            'type_id' => 1,
            'parent_id' => null,
            'order' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('section_translations')->insert([
            'section_id' => 1,
            'locale' => 'en',
            'title' => 'Home',
            'keywords' => 'home',
            'slug' => '/home',
            'desc' => 'this is section short desc',
            'locale_additional' => null,
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

    }
}
