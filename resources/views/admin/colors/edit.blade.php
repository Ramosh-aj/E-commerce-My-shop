@extends('layouts.admin')

@section('content')
<div class="row">
        @if(session('message'))
                    <div class="alert alert-success">{{session('message')}}</div>
        @endif
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Edit Color 
                    <a href="{{url('admin/colors')}}" class="btn btn-danger btn-sm text-white float-end">
                        Back
                    </a>
                </h3>    
            </div>
            <div class="card body">
                <form action="{{url('admin/colors/'.$color->id)}}" method="POST">
                    @csrf  
                    @method('PUT')
                    <div class="col-md-6 mb-3">
                        <label>Color Name</label>
                        <input type="text" name="name" value="{{$color->name}}" class="form-controll"/>
                        @error('name')<small class="text-danger">{{$message}}</small>@enderror
                    </div> 
                    <div class="col-md-6 mb-3">
                        <label>Color Code</label>
                        <input type="text" name="code" value="{{$color->code}}" class="form-controll"/>
                        @error('name')<small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Status</label></br>
                        <input type="checkbox" name="status" {{$color->status ? 'checked':''}} style="width=50px;height=50px;" />
                        Checked=Hidden,UnChecked=visible
                    </div>
                    <div class="col-md-6 mb-3 mb-3">
                        <button type = "submit" class="btn btn-primary float-end">Update</button>
                    </div>
                </form>     
            </div>
        </div>
    </div>
</div>            
@endsection    