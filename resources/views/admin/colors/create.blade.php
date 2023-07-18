@extends('layouts.admin')

@section('content')
<div class="row">
        @if(session('message'))
                    <div class="alert alert-success">{{session('message')}}</div>
        @endif
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Color 
                    <a href="{{url('admin/colors')}}" class="btn btn-danger btn-sm text-white float-end">
                        Back
                    </a>
                </h3>    
            </div>
            <div class="card body">
                <form action="{{url('admin/colors/create')}}" method="POST">
                    @csrf  
                    <div class="col-md-6 mb-3">
                        <label>Color Name</label>
                        <input type="text" name="name" class="form-controll"/>
                        @error('name')<small class="text-danger">{{$message}}</small>@enderror
                    </div> 
                    <div class="col-md-6 mb-3">
                        <label>Color Code</label>
                        <input type="text" name="code" class="form-controll"/>
                        @error('name')<small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Status</label></br>
                        <input type="checkbox" name="status" style="width=50px;height=50px;" />
                        Checked=Hidden,UnChecked=visible
                    </div>
                    <div class="col-md-6 mb-3 mb-3">
                        <button type = "submit" class="btn btn-primary float-end">Save</button>
                    </div>
                </form>     
            </div>
        </div>
    </div>
</div>            
@endsection    