<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'title' => 'Welcome to Portal Berita',
                'news_content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id autem illo corporis magni, esse necessitatibus odio harum voluptatum, est ipsa rem aperiam accusamus recusandae repudiandae rerum atque sed. Odio, veniam!',
                'author' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
        ]);
    }
}
