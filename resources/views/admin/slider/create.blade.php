@extends('layouts.admin')

@section('content')
<div class="row">
        @if(session('message'))
                    <div class="alert alert-success">{{session('message')}}</div>
        @endif
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Slider 
                    <a href="{{url('admin/sliders')}}" class="btn btn-danger btn-sm text-white float-end">
                        Back
                    </a>
                </h3>    
            </div>
            <div class="card body">
                <form action="{{url('admin/sliders/create')}}" method="POST" enctype="multipart/form-data">
                    @csrf  
                    <div class="mb-3">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control">
                        @error('title')<small class="text-danger">{{$message}}</small>@enderror
                    </div> 
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-controll" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-controll"/>
                    </div> 
                    <div class="mb-3">
                        <label>Status</label><br/>
                        <input type="checkbox" name="status" style="width=30px;height=30px;" >
                        Checked=Hidden,UnChecked=visible
                    </div>
                    <div class="mb-3">
                        <button type = "submit" class="btn btn-primary float-end">Save</button>
                    </div>
                </form>     
            </div>
        </div>
    </div>
</div>            
@endsection    