@extends('layouts.master')

@section('content')
<div class="container-fluid card shadow mb-4">
    <h1 class="heading">Product Categories</h1>    
        <a class="btn btn-primary add-button" href="{{ route('product-cats.create') }}">Add</a>
        
    <div class="card mb-4 shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table cellspacing="0" class="table table-bordered" id="product-cat" width="100%">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Image</th>

                            <th>Description</th>
                            <th>Meta title</th>
                            <th>Meta footer</th>
                            <th>Meta description</th>
                            <th>Is Parent</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                 
                    <tbody id="sortable">
                        @foreach($cats as $key => $cat)
                        <tr data-id="{{ $cat->id }}" data-order="{{ $key + 1 }}">
                            <th>{{ $key + 1 }}</th>
                            <td>{{ $cat->category }}</td>
                            <td>
                                @if($cat->image)
                                <img src="{{ asset('storage/' . $cat->image) }}" alt="Thumbnail" width="100">
                                @else
                                No Image
                                @endif
                            </td>
                            <td>{{ $cat->description }}</td>
                            <td>{{ $cat->meta_title }}</td>
                            <td>{{ $cat->meta_footer }}</td>
                            <td>{{ $cat->meta_description }}</td>
                            <td>{{ $cat->is_parent == 1 ? 'Yes' : 'No' }}</td>
                            <td colspan="2">
                                <a class="btn btn-success" href="{{ route('product-cats.edit', $cat->id) }}">Edit</a>
                                <a class="btn btn-danger" onclick="AsktoDel({{ $cat->id }})">Delete</a>
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
@push('style')
<style>
    .add-button {
        width: 150px;
        position: absolute;
        right: 25px;
        top: 43px;
        border-radius: 4px;
    }

    .heading {
        padding: 22px 0px;
    }
</style>
@endpush
@push('scripts')
<script type="text/javascript">
     $(document).ready(function() {
        $('#product-cat').DataTable({
        });
    });

    function AsktoDel(id) {
        console.log("ID deleted is" + id)
        swal({
            title: "Are you sure you want to delete this Category",
            text: "Once deleted, you will not be able to recover this Category",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "{{ route('product-cats.destroy', '') }}/" + id,
                    type: 'GET',
                    success: function (data) {
                        swal("Poof! Your Category has been deleted!", {
                            icon: "success",
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 800);
                    }
                });
            } else {
                swal("Your Category is safe!");
            }
        });
    }
</script>
@endpush
