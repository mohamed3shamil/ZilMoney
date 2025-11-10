<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $languages = ['English', 'Spanish', 'French', 'German', 'Chinese', 'Japanese'];

        foreach ($languages as $language) {
            \App\Models\Languages::create(['lanuage_name' => $language]);
        }
    }
}
