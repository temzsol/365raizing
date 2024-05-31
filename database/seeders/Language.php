<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class Language extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'PHP',
                'slug' => \Str::slug('PHP'),
                'created_at' => now(),
            ],
            [
                'Laravel' => 'Laravel',
                'slug' => \Str::slug('Laravel'),
                'created_at' => now(),
            ],
            [
                'Html' => 'Html',
                'slug' => \Str::slug('Html'),
                'created_at' => now(),
            ],
            [
                'Bootstrap' => 'Bootstrap',
                'slug' => \Str::slug('Bootstrap'),
                'created_at' => now(),
            ],
            [
                'Kotlin' => 'Kotlin',
                'slug' => \Str::slug('Kotlin'),
                'created_at' => now(),
            ],
        ];
        App\Models\Language::insert($data);
    }
}
