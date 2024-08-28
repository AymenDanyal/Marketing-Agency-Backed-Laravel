@extends('layouts.master')

@section('content')
<div class="container-fluid card shadow mb-4">
    <h1  class="heading">Blog Category</h1>

    <a href="{{ route('blogCat.create') }}" class="btn btn-primary add-button">Add Category</a>

    <!-- DataTable -->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">

                <table id="blogsTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogCat as $cat)
                        <tr>
                            <td>{{ $cat->category }}</td>
                            <td>{{ $cat->slug }}</td>
                            <td>
                                <a href="{{ route('blogCat.edit', $cat->id) }}" class="btn btn-success">Edit</a>
                                <form action="{{ route('blogCat.destroy', $cat->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this blog?');">Delete</button>
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
    .add-button{ 
        width: 150px;
        position: absolute;
        right: 25px;
        top: 43px;
        border-radius: 4px;
    }
    .heading{
        padding: 22px 0px;
    }
</style>
@endpush
@push('scripts')
<script>
    $(document).ready(function() {
        $('#blogsTable').DataTable({
            "paging": true,
            "searching": true,
            "info": true
        });
    });
</script>
@endpush