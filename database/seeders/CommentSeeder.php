<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::create([
            'message'=>'Best post',
            'user_id'=>'1',
            'post_id'=>'1'
        ]);
        Comment::create([
            'message'=>'It gives very useful information',
            'user_id'=>'1',
            'post_id'=>'2'
        ]);
        Comment::create([
            'message'=>'I loved it',
            'user_id'=>'1',
            'post_id'=>'3'
        ]);
    }
}
