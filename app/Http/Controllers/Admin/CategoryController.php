<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request\UploadedFile;
use App\Http\Requests\CategoryFormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Category;


class CategoryController extends Controller
{
    //
    public function index()
    {
        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();
        $category= new Category;
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];
        
        $uploadPath = 'uploads/category/';
        //read and save the new image in folder
        if($request->hasFile('image')){
            $file =$request->file('image');
            $ext =$file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/category/',$filename);
            $category->image = $uploadPath.$filename;            
        }


        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];
        $category->status = $request->status ==true ? '1':'0';
        $category->save();  

        return redirect('admin/category')->with('message','Category Added Successfuly');
    }


    public function edit(Category $category)
    {


        return view('admin.category.edit',compact('category'));

    }
    public function update(CategoryFormRequest $request , $category)
    {
        $validatedData = $request->validated();

        $category = Category::findOrFail($category);
        
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        if($request->hasFile('image')){
        $uploadPath = 'uploads/category/';

            $path = 'uploads/category/'.$category->image;
            //delete the old image
            if(File::exists($path)){
                File::delete($path);
            }

            //read and save the new image in the folder
            $file =$request->file('image');
            $ext =$file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/category/',$filename);
            $category->image = $uploadPath.$filename;            
        }


        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];
        $category->status = $request->status ==true ? '1':'0';
        $category->update();  

        return redirect('admin/category')->with('message','Category Updated Successfuly');
    }



}
