<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Image;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug', 'content', 'thumbnail','status',
    ];

    public function category(){
        return $this->belongsTo(Category::class)->select('id','name','slug');
    }

    public function user(){
        return $this->belongsTo(User::class)->select('id','name');
    }

    public static function savePostInfo($request){

        $file       = explode(';', $request->thumbnail);
        $file       = explode('/', $file[0]);
        $file_ex    = end($file);
        $slug       = slugify($request->title);
        $file_name  = $slug. '.' .$file_ex;

        $success= Post::create([
            'user_id'      =>Auth()->user()->id,
            'title'        =>$request->title,
            'slug'         =>$slug,
            'status'       =>$request->status,
            'content'      =>$request->content,
            'category_id'  =>$request->category_id,
            'thumbnail'    =>$file_name,
        ]);
                if( $success){
                    Image::make($request->thumbnail)->resize(250,200)->
                    save(public_path('assets/images/').$file_name);
                }

            }

    public static function updatePostInfo($request){

        $post                = Post::find($request->id);
        $post ->title        = $request->title;
        $post ->slug         = slugify($request->title);
        $post ->status       = $request->status;
        $post ->content      = $request->content;
        $post ->category_id  = $request->category_id;

        $fileName            =$post->thumbnail;
           if(file_exists(public_path('assets/images/'.$fileName))){
            unlink(public_path('assets/images/'.$fileName));
           }

        if($request->thumbnail !== $post->thumbnail){
            $file                = explode(';', $request->thumbnail);
            $file                = explode('/', $file[0]);
            $file_ex             = end($file);
            $slug                = slugify($request->title);
            $file_name           = $slug. '.' .$file_ex;
            $post ->thumbnail    =$file_name;
            Image::make($request->thumbnail)->resize(250,200)->
            save(public_path('assets/images/').$file_name);

        }
         $post->save();


     }


}
