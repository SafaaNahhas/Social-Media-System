<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        // return(111111);
        $request->validate([
            'category_id'=>['integer'],
        ]);

        $categoryid= $request->category_id;
        // لو رح رجع أكتر من شغلة
        // $posts= PostResource::collection(Post::all());
        $posts= PostResource::collection(Post::with('comments','user')->with('category')->where('category_id',$categoryid)->get());
        // ->with('')->where('category_id',$categoryid)->get();
        return $this->apiResponse($posts,'true',200);
    }
    public function show($id){

        // $post=Post::find($id);

        // لو رح رجع شغلة وحدة
        $post=Post::find($id);
        if($post){
        return $this->apiResponse(new PostResource($post),'true',200);
        }
        else
        return $this->apiResponse(null,'This Post Not Found',404);
    }


    public function store(Request $request){
        $validator= Validator::make($request->all(),[
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id'=>['required','integer','exists:categories,id'],
        ]);
        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $post =Post::create($request->all());
        if($post){
            return $this->apiResponse(new PostResource($post),'This Post Save',201);
            }
        return $this->apiResponse(null,'This Post Not Save',400);

    }
    public function update(Request $request,$id){
        $validator= Validator::make($request->all(),[
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $post=Post::find($id);
        if(!$post){
            return $this->apiResponse(null,'This Post Not Found',404);
        }
        $post->update($request->all());
        if($post){
        return $this->apiResponse(new PostResource($post),'This Post Update',201);}

    }
    public function destroy($id){
        $post=Post::find($id);
        if(!$post){
            return $this->apiResponse(null,'This Post Not Found',404);
        }
        $post->delete();
        if($post){
            return $this->apiResponse(null,'This Post Deleted',200);}

    }


}
