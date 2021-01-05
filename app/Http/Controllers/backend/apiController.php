<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Post;

class apiController extends Controller
{
   public function getCategories(){

   	 $categories = Category::where('status', 1)->get();

        return $categories;
   }

   public function getPosts(){

   	 $posts = Post::where('status', 'published')->get();

        return 	$posts;
   }
}
