@extends('layouts.master')

@section('content')
<div class="container-fluid card shadow mb-4">
    <h1 class="heading">Pages</h1>

    <a href="{{ route('pages.create') }}" class="btn btn-primary add-button">Add Page</a>

    <!-- DataTable -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="pagesTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno = 1; // Initialize S.no
                        @endphp
                        @foreach($pages as $page)
                        <tr>
                            <td>{{ $sno }}</td>
                            <td>{{ $page->name }}</td>
                            <td>{{ $page->slug }}</td>
                            <td>
                                <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-success">Edit</a>
                                <form action="{{ route('pages.destroy', $page->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this page?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @php
                            $sno++; // Increment S.no
                        @endphp
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
    $(document).ready(function() {
        $('#pagesTable').DataTable({
            "paging": true,
            "searching": true,
            "info": true
        });
    });
</script>
@endpush
    