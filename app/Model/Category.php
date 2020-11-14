<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
            'name', 'slug', 'status',
    ];

    public function posts(){
        return $this->hasMany(Post::class, 'category_id', 'id');
    }

    public static function saveCategoryInfo($request){

        //        return $request->all();
        //            DB::table('categories')->insert([
        //                'category_name' =>$request->category_name,
        //                'category_description' =>$request->category_description,
        //                'publication_status' =>$request->publication_status
        //            ]);

               $category          = new Category();
               $category->name    =$request->name;
               $category->slug    =slugify($request->name);
               $category->status  =$request->status;
               $category->save();

                // Category::create ($request->all());

            }

}
