<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SliderForRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    //
    public function index()
    {   $sliders = Slider::all();
        return view('admin.slider.index',compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(SliderForRequest $request)
    {
        $validatedData = $request->validated();
                //read and save the new image in folder
        if($request->hasFile('image')){
            $file =$request->file('image');
            $ext =$file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/sliders/',$filename);
            $validatedData['image'] = "uploads/sliders/$filename";            
        }

        $validatedData['status'] = $request->status == true ? '1':'0';
        
        Slider::create([
            'title' =>  $validatedData['title'],
            'description' =>  $validatedData['description'],
            'image' => $validatedData['image']  ,
            'status' => $validatedData['status'],
        ]);

        return redirect('admin/sliders')->with('message','Slider Added Successfuly');
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit',compact('slider'));
    }

    public function update(SliderForRequest $request, Slider $slider)
    {
        // return $slider;
        $validatedData = $request->validated();
                //read and save the new image in folder
        if($request->hasFile('image')){

            $path = $slider->image;
            //delete the old image
            if(File::exists($path)){
                    File::delete($path);
            }

            $file =$request->file('image');
            $ext =$file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/sliders/',$filename);
            $validatedData['image'] = "uploads/sliders/$filename";            
        }

        $validatedData['status'] = $request->status == true ? '1':'0';
        
        Slider::where('id',$slider->id )->update([
            'title' =>  $validatedData['title'],
            'description' =>  $validatedData['description'],
            'image' => $validatedData['image'] ?? $slider->image,
            'status' => $validatedData['status'],
        ]);

        return redirect('admin/sliders')->with('message','Slider Updated Successfuly');
    }

    public function destroy( Slider $slider)
    {
        if ($slider->count() > 0 ){
            $path = $slider->image;
            //delete the old image
            if(File::exists($path)){
                    File::delete($path);
            }
            $slider->delete();
            return redirect('admin/sliders')->with('message','Slider Deleted Successfuly');

        }
        return redirect('admin/sliders')->with('message','Some thing went wrong');


    }

}
