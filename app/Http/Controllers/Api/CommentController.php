<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;


class CommentController extends Controller
{
    use ApiResponseTrait;
    public function create($post_id,Request $request){

    $post =Post::where('id',$post_id)->first();
    if($post){
        $validator= Validator::make($request->all(),[
        'message' => 'required',]);
        if($validator->fails()){
        return $this->apiResponse(null,$validator->errors(),422);}
        $comment =Comment::create([
            'message' =>$request->message,
            'post_id' =>$post->id,
            'user_id' =>$request->user()->id,
        ]);
        $comment->load('user');
        return $this->apiResponse($comment,'This Comment Save',201);
    }
    else{
    return $this->apiResponse(null,'This Comment Not Save',400);}

}
    public function list($post_id,Request $request){

    $post =Post::where('id',$post_id)->first();
    if($post){

        $comment =Comment::where('post_id',$post_id)->get();
        $comment->load('user');
        return $this->apiResponse($comment,'Comment Successfuly fetched',200);
    }
    else{
    return $this->apiResponse(null,'This Comment Not Found',400);}

}
    public function update($comment_id,Request $request){
        $comment =Comment::with(['user'])->where('id',$comment_id)->first();
        $comment->load('user');
        if($comment){
            if($comment->user_id == $request->user()->id){
                $validator= Validator::make($request->all(),[
                    'message' => 'required',]);
                    if($validator->fails()){
                    return $this->apiResponse(null,$validator->errors(),422);
                }
                $comment->update([
                    'message' =>$request->message,
                    // 'user_id'=>$request->user_id,
                    // 'post_id'=>$request->post_id,
                ]);
                return $this->apiResponse($comment,'Comment Successfuly Updated',200);
            }
            else{
                return $this->apiResponse(null,'Access denied',403);
            }
        }
        else{
            return $this->apiResponse(null,'This Comment Not Found',400);
        }



    }
    public function delete($comment_id,Request $request){
        $comment =Comment::where('id',$comment_id)->first();
        $comment->load('user');
        if($comment){
            if($comment->user_id == $request->user()->id){

                $comment->delete();
                return $this->apiResponse($comment,'Comment Successfuly Deleted',200);
            }
            else{
                return $this->apiResponse(null,'Access denied',403);
            }
        }
        else{
            return $this->apiResponse(null,'This Comment Not Found',400);
        }
    }
}
