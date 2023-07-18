<div>
    <!-- model of delete -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Category Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="model" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent= "destroyCategory">
                    <div class="modal-body">
                        <h6>Are you sure you want to Delete this data?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn-btn-primary">Yes. Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>   
    

    

    <div class="row">
        <div class="col-md-12">
            @if(session('message'))
                <div class="alert-alert-succses">{{session('message')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Category
                        <a href="{{url('admin/category/create')}}" class="btn btn-primary btn-sm float-end">Add Category</a>
                        </h3>    
                    </div>
                    <div class="card body">
                        <table class = "table tabel-bordered table-striped">
                            <div>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($categories as $category)
                                        
                                        <tr>
                                            <td>{{$category->id}}</td>
                                            <td>{{$category->name}}</td>
                                            <td>{{$category->status == '1' ? 'Hidden':'Visible'}}</td>
                                            <td> 
                                                <!-- update -->
                                                <a href = "{{url('admin/category/'.$category->id.'/edit')}}" class="btn btn-success">Edit</a>
                                                <!-- delete -->
                                                <a href = "#" wire:click="deleteCategory({{$category->id}})" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr> 
                                        @endforeach
                                </tbody>
                            </div>
                            
                        </table>
                        <div>
                            {{$categories->links()}}
                        </div>
                    </div>
                </div>    
        </div>
    </div>
</div>

<!-- To keep the model showing -->
@push('script')
    <script>
        window.addEventListener('close-modal',event=>{
            $('#deleteModal').modal('hide');
        });
    </script>

@endpush
