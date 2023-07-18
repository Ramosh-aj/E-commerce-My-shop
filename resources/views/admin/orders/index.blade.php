@extends('layouts.admin')

@section('title','My Orders')

@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>My Orders</h3>    
            </div>
                    <div class="card body">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Filter By Date</label>
                                    <input type="date" name="date" vale="{{Request::get('date') ?? date('Y-m-d')}}" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>Filter By Status</label>
                                    <select name="status" class="form-select">
                                        <option value="">Select All Status</option>
                                        <option value="in progress" value="{{Request::get('status') == 'in progress'? 'selected':''}}" >In Progress</option>
                                        <option value="completed" value="{{Request::get('status') == 'completed'? 'selected':''}}" >Completed</option>
                                        <option value="pending" value="{{Request::get('status') == 'pending'? 'selected':''}}" >Pending</option>
                                        <option value="cancelled" value="{{Request::get('status') == 'cancelled'? 'selected':''}}" >Cancelled</option>
                                        <option value="out-for-delivery" value="{{Request::get('status') == 'out-for-delivery'? 'selected':''}}" >Out For Delivery</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <br/>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>Order Id</th>
                                <th>Tracking No</th>
                                <th>UserName</th>
                                <th>Payment Mode</th>
                                <th>ordered Date</th>
                                <th>Status Message</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse($orders as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->traking_no}}</td>
                                    <td>{{$item->fullname}}</td>
                                    <td>{{$item->payment_mode}}</td>
                                    <td>{{$item->created_at->format('d-m-Y')}}</td>
                                    <td>{{$item->status_message}}</td>
                                    <td><a href="{{url('admin/orders/'.$item->id)}}" class="btn btn-primary btn-sm">View</a></td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Orders available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>  
                        <div>
                            {{$orders->links()}}
                        </div>                  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection