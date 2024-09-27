@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-left">
                    <h1 class="h4 mb-4 text-gray-900">Edit Video</h1>
                </div>
                <form action="{{ route('videos.update', ['id' => $video->id]) }}" class="user" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <input name="id" value="{{$video->id}}" type="hidden">
                    <div class="row form-group">
                        <div class="col-sm-12 mb-3">
                            <label>Video Title</label> 
                            <input name="title" value="{{$video->title}}" class="form-control" placeholder="Video Title" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label>Media Type</label> 
                            <input name="media_type" value="{{$video->media_type}}" class="form-control" placeholder="Media Type" required>
                        </div>
                        
                        <div class="col-sm-8 mt-2">
                            <button class="btn btn-block btn-primary btn-user" type="submit">Edit Video</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
