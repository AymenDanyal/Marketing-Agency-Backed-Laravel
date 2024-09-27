@extends('layouts.master')

@section('content')
<div class="container-fluid card shadow mb-4">
    <h1 class="heading">Videos</h1>

    <a href="{{ route('videos.create') }}" class="btn btn-primary add-button">Add Video</a>

    <!-- DataTable -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="videosTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Title</th>
                            <th>Media Type</th>
                            <th>Tags</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno = 1; // Initialize S.no
                        @endphp
                        @foreach($videos as $video)
                        <tr>
                            <td>{{ $sno }}</td>
                            <td>{{ $video->title }}</td>
                            <td>{{ $video->media_type }}</td>
                            <td>
                                @foreach($video->tags as $tag)
                                   <span class="tags"> {{ $tag->name }}</span>
                                @endforeach
                            </td>
                            
                            <td>
                                <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-success">Edit</a>
                                <form action="{{ route('videos.destroy', $video->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this video?');">
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
    .tags{
        background-color: #eaecf4;
        padding: 2px 10px;
        border-radius: 12px;
    }
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
        $('#videosTable').DataTable({
            "paging": true,
            "searching": true,
            "info": true
        });
    });
</script>
@endpush
