@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Colors List
                    <a href="{{url('admin/colors/create')}}" class="btn btn-primary btn-sm text-white float-end">
                        Add Color
                    </a>
                </h3>    
            </div>
            <div class="card body">
            <table class="table table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Color Name</th>
                                    <th>Color Code</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($colors as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>                
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->code}}</td>
                                        <td>{{$item->status == '1' ? 'Hidden':'Visible'}}</td>
                                        <td>
                                            <a href="{{url('admin/color/'.$item->id.'/edit')}}" class="btn btn-success">Edit</a>
                                            <a href="{{url('admin/color/'.$item->id.'/delete')}}" 
                                                onclick="return confirm('Are you sure,you want to delete this Data?')" 
                                                class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        
            </div>
        </div>
    </div>
</div>            
@endsection 