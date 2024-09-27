@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-left">
                    <h1 class="h4 mb-4 text-gray-900">Add Video</h1>
                </div>
                <form action="{{ route('videos.store') }}" class="user" enctype="multipart/form-data" method="POST">
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

                    <div class="row form-group">
                        <div class="col-sm-12 mb-3">
                            <label>Video Title</label> 
                            <input name="title" class="form-control" placeholder="Video Title" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label>Media Type</label> 
                            <input name="media_type" class="form-control" placeholder="Media Type" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="tags" class="font-weight-bold">Select Tags</label>
                            <div class="scrollable-checkboxes">
                                @foreach($tags as $tag)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                               id="tag{{ $tag->id }}"
                                               @if(in_array($tag->id, $selectedTags)) checked @endif>
                                        <label class="form-check-label" for="tag{{ $tag->id }}">
                                            <span class="tag-name">{{ $tag->name }}</span>
                                            <small class="tag-description">{{ $tag->description }}</small>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                      
                        <div class="col-sm-8 mt-2">
                            <button class="btn btn-block btn-primary btn-user" type="submit">Add Video</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
