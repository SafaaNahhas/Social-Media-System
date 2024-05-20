<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title'=>'Math',
            'body'=>'Mathematics is a subject that has facilitated
            and clarified many areas of life',
            'user_id'=>'1',
            'category_id'=>'1'
        ]);
        Post::create([
            'title'=>'Science',
            'body'=>'Science helps people understand their bodies, the diseases that may affect
            them, and how to deal with them',
            'user_id'=>'1',
            'category_id'=>'1'
        ]);
        Post::create([
            'title'=>'Animation',
            'body'=>'Animation is what gives a person an imaginative look at different topics and
            contributes to his entertainment',
            'user_id'=>'1',
            'category_id'=>'3'
        ]);
    }
}
