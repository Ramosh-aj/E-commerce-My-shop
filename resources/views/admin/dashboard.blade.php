@extends('layouts.admin')

@section('content')
<div class="row">
            <div class="col-md-12 grid-margin">
           
                        @if(session('message')) 
                            <h2 class="alert-alert-succcess">{{session('message')}},</h2>
                        @endif
                        <div class="me-md-3 me-xl-5">
                                    <h2>Dashboard,</h2>    
                                    <p class="mb-md-0">Your analytics dashboard template.</p>
                                    <hr>
                        </div>

                        <!-- order details -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card card-body bg-primary text-white mb-3">
                                    <label>Total Orders</label>
                                    <h1>{{$totalOrder}}</h1>
                                    <a href="{{url('admin/orders')}}" class="text-white">View</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-body bg-success text-white mb-3">
                                    <label>Today Orders</label>
                                    <h1>{{$todayOrder}}</h1>
                                    <a href="{{url('admin/orders')}}" class="text-white">View</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-body bg-warning text-white mb-3">
                                    <label>This Month Orders</label>
                                    <h1>{{$thisMonthOrder}}</h1>
                                    <a href="{{url('admin/orders')}}" class="text-white">View</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-body bg-danger text-white mb-3">
                                    <label>Year Orders</label>
                                    <h1>{{$thisYearOrder}}</h1>
                                    <a href="{{url('admin/orders')}}" class="text-white">View</a>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!-- product details -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card card-body bg-primary text-white mb-3">
                                    <label>Total Product</label>
                                    <h1>{{$totalProducts}}</h1>
                                    <a href="{{url('admin/products')}}" class="text-white">View</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-body bg-success text-white mb-3">
                                    <label>Total Category</label>
                                    <h1>{{$totalCategories}}</h1>
                                    <a href="{{url('admin/category')}}" class="text-white">View</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-body bg-warning text-white mb-3">
                                    <label>Total Brands</label>
                                    <h1>{{$totalBrands}}</h1>
                                    <a href="{{url('admin/brands')}}" class="text-white">View</a>
                                </div>
                        </div>
                        <hr>

                          <!-- product details -->
                          <div class="row">
                            <div class="col-md-3">
                                <div class="card card-body bg-primary text-white mb-3">
                                    <label>All User</label>
                                    <h1>{{$totalAllUsers}}</h1>
                                    <a href="{{url('admin/users')}}" class="text-white">View</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-body bg-success text-white mb-3">
                                    <label>Total Users</label>
                                    <h1>{{$totalUser}}</h1>
                                    <a href="{{url('admin/users')}}" class="text-white">View</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-body bg-warning text-white mb-3">
                                    <label>Total Admins</label>
                                    <h1>{{$totalAdmin}}</h1>
                                    <a href="{{url('admin/users')}}" class="text-white">View</a>
                                </div>
                        </div>
                        <hr>
   
                </div>
   
            </div>
   
        </div>
@endsection