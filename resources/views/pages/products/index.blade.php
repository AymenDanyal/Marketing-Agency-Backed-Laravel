@extends('layouts.master')

@section('content')
<div class="container-fluid card shadow mb-4">


    <h1 class="heading">Products</h1>
    <a class="btn btn-primary add-button" href="{{ route('products.create') }}">Add</a>
    <div class="card">

        <div class="card-body">
            <div class="table-responsive">
                <table id="productTable" class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Summary</th>
                            <th>Description</th>
                            <th>Meta Title</th>
                            <th>Meta Description</th>
                            <th>Meta Footer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody id="sortable">
                        @foreach($products as $key => $product)
                        <tr data-id="{{ $product->id }}" data-order="{{ $key + 1 }}">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $product->title ?? 'N/A' }}</td>
                            <td>
                                @if($product->image)
                                <img  src="{{ asset('storage/' . $product->image) }}" alt="Thumbnail" width="100">
                                
                                @else
                                No Image
                                @endif
                            </td>
                            <td>{{ optional($product->category)->category ?? 'N/A' }}</td>
                            <td>{{ $product->summary ?? 'N/A' }}</td>
                            <td>{{ $product->description ?? 'N/A' }}</td>
                            <td>{{ $product->meta_title ?? 'N/A' }}</td>
                            <td>{{ $product->meta_description ?? 'N/A' }}</td>
                            <td>{{ $product->meta_footer ?? 'N/A' }}</td>
                            <td>
                                <a class="btn btn-success" href="{{ route('products.edit', $product->id) }}">Edit</a>
                                <form id="delete-form-{{ $product->id }}" action="{{ route('products.delete', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="confirmDeletion({{ $product->id }})">Delete</button>
                                </form>
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
<script>
    function confirmDeletion(productId) {
        swal({
            title: "Are you sure you want to delete this product?",
            text: "Once deleted, you will not be able to recover this product!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                // Programmatically submit the form if confirmed
                document.getElementById('delete-form-' + productId).submit();
            } else {
                swal("Your product is safe!");
            }
        });
    }

    $(document).ready(function() {
        $('#productTable').DataTable({
        });

        
    });

  
</script>
@endpush