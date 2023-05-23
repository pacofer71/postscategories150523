<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts=Post::all();
        $tags=Tag::all()->pluck('id')->toArray(); // [1,2,3,4,5,6,7]
        foreach($posts as $post){
            unset($mistags);
            $mistags=[];
            for($i=0; $i<random_int(1,3); $i++){
                do{
                    $provisional=random_int(1,7);
                }while(in_array($provisional, $mistags));
                $mistags[$i]=$provisional;
            }
            $post->tags()->attach($mistags);
        }
    }
}
