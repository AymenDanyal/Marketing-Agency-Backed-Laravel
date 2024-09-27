@extends('layouts.master')

@section('content')
<div class="container-fluid card shadow mb-4">
    <h1 class="heading">Jobs</h1>

    <a href="{{ route('jobs.create') }}" class="btn btn-primary add-button">Add Job</a>

    <!-- DataTable -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="jobsTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno = 1; // Initialize S.no
                        @endphp
                        @foreach($jobs as $job)
                        <tr>
                            <td>{{ $sno }}</td>
                            <td>{{ $job->title }}</td>
                            <td>{{ Str::limit($job->description, 50) }}</td>
                            <td>
                                @if($job->image)
                                <img src="{{ $job->image }}" alt="Job Image" width="100">
                                @else
                                No Image
                                @endif
                            </td>
                            <td>{{ $job->status ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-success">Edit</a>
                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this job?');">
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
        $('#jobsTable').DataTable({
            "paging": true,
            "searching": true,
            "info": true
        });
    });
</script>
@endpush
