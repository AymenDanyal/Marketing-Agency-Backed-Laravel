@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-left">
                    <h1 class="h4 mb-4 text-gray-900">Edit Testimonial</h1>
                </div>
                <form action="{{ route('testimonials.update', ['id' => $testimonial->id]) }}" class="user" enctype="multipart/form-data" method="POST">
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
                    <input name="id" value="{{ $testimonial->id }}" type="hidden">

                    <!-- Person Name -->
                    <div class="row form-group">
                        <div class="col-sm-12 mb-3">
                            <label>Person</label> 
                            <input name="person" value="{{ $testimonial->person }}" class="form-control" placeholder="Person's Name" required>
                        </div>

                        <!-- Comment -->
                        <div class="col-sm-12 mb-3">
                            <label>Comment</label> 
                            <textarea name="comment" class="form-control" rows="4" placeholder="Testimonial Comment" required>{{ $testimonial->comment }}</textarea>
                        </div>

                        <!-- Image Upload (with LFM) -->
                        <div class="col-sm-12 mb-3">
                            <label>Image</label> 
                            <div class="input-group">
                                <input id="image" class="form-control lfm" name="image" type="text" value="{{ $testimonial->image }}" required>
                                <span class="input-group-btn">
                                    <a data-input="image" data-preview="image-holder" class="btn btn-primary lfm">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                            </div>
                            <div id="image-holder" style="margin-top:15px;max-height:100px;">
                                @if ($testimonial->image)
                                    <img src="{{ asset($testimonial->image) }}" alt="Image" width="100">
                                @endif
                            </div>
                        </div>

                        <!-- Logo Upload (with LFM) -->
                        <div class="col-sm-12 mb-3">
                            <label>Logo</label> 
                            <div class="input-group">
                                <input id="logo" class="form-control lfm" name="logo" type="text" value="{{ $testimonial->logo }}" required>
                                <span class="input-group-btn">
                                    <a data-input="logo" data-preview="logo-holder" class="btn btn-primary lfm">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                            </div>
                            <div id="logo-holder" style="margin-top:15px;max-height:100px;">
                                @if ($testimonial->logo)
                                    <img src="{{ asset($testimonial->logo) }}" alt="Logo" width="100">
                                @endif
                            </div>
                        </div>

                        <!-- Tags Selection -->
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

                        <!-- Submit Button -->
                        <div class="col-sm-8 mt-2">
                            <button class="btn btn-block btn-primary btn-user" type="submit">Update Testimonial</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('style')
<style>
    /* Custom styling as before */
    .font-weight-bold {
        font-size: 1.1rem;
        margin-bottom: 10px;
        display: block;
        color: #333;
    }
    .scrollable-checkboxes {
        max-height: 200px;
        overflow-y: scroll;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 0px 28px;
        background-color: #fff;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    .form-check {
        padding: 8px 0;
        border-bottom: 1px solid #eaeaea;
    }
    .form-check:last-child {
        border-bottom: none;
    }
    .form-check-label {
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        cursor: pointer;
    }
    .form-check-input {
        margin-right: 10px;
    }
    .tag-name {
        font-weight: 600;
        color: #333;
    }
    .tag-description {
        margin-left: 10px;
        color: #888;
        font-size: 0.85rem;
    }
    .form-check:hover {
        background-color: #f1f1f1;
        transition: background-color 0.3s ease;
    }
    .scrollable-checkboxes::-webkit-scrollbar {
        width: 8px;
    }
    .scrollable-checkboxes::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 10px;
    }
    .scrollable-checkboxes::-webkit-scrollbar-track {
        background-color: #f9f9f9;
    }
</style>
@endpush

@push('scripts')
<script>
    jQuery(document).ready(function($) {
        var route_prefix = "{{ url('/laravel-filemanager') }}";
        
        // Initialize the file manager for image field
        $('.lfm').filemanager('image', {prefix: route_prefix});
    });
</script>
@endpush
