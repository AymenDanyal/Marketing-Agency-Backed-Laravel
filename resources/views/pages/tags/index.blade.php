@extends('layouts.master')

@section('content')
<div class="container-fluid card shadow mb-4">
    <h1 class="heading">Tags</h1>

    <a href="{{ route('tags.create') }}" class="btn btn-primary add-button">Add Tag</a>

    <!-- DataTable -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tagsTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno = 1; // Initialize S.no
                        @endphp
                        @foreach($tags as $tag)
                        <tr>
                            <td>{{ $sno }}</td>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->description }}</td>
                            <td>
                                <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-success">Edit</a>
                                <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this tag?');">
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
        $('#tagsTable').DataTable({
            "paging": true,
            "searching": true,
            "info": true
        });
    });
</script>
@endpush
