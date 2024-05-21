<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories= CategoryResource::collection(Category::with('posts')->get());
        return $this->apiResponse($categories,'true',200);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'name'=>['required','string'],
        ]);
        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);}
        $category =Category::create($request->all());
        if($category){
            return $this->apiResponse(new CategoryResource($category),'This Category Save',201);
            }
        return $this->apiResponse(null,'This Category Not Save',400);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $category = new CategoryResource(Category::where ('category_id',category->id)->first());


        $category=Category::find($id);
        if($category){
        return $this->apiResponse(new CategoryResource($category),'true',200);
        }
        else
        return $this->apiResponse(null,'This Category Not Found',404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator= Validator::make($request->all(),[
            'name'=>['required','string'],

        ]);
        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $category=Category::findOrFail($id);
        if(!$category){
            return $this->apiResponse(null,'This Category Not Found',404);
        }
        $category->update($request->all());
        if($category){
        return $this->apiResponse(new CategoryResource($category),'This Category Update',201);}
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category=Category::findOrFail($id);
        if(!$category){
            return $this->apiResponse(null,'This Category Not Found',404);
        }
        $category->delete();
        if($category){
            return $this->apiResponse(null,'This Category Deleted',200);}
    }
}
