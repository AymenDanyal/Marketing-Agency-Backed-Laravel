@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-left">
                    <h1 class="h4 mb-4 text-gray-900">Add Testimonial</h1>
                </div>
                <form action="{{ route('testimonials.store') }}" class="user" enctype="multipart/form-data" method="POST">
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
                        <!-- Person Name -->
                        <div class="col-sm-12 mb-3">
                            <label>Person</label> 
                            <input name="person" class="form-control" placeholder="Person's Name" required>
                        </div>

                        <!-- Comment/Feedback -->
                        <div class="col-sm-12 mb-3">
                            <label>Comment</label> 
                            <textarea name="comment" class="form-control" rows="4" placeholder="Comment or Testimonial" required></textarea>
                        </div>

                        <!-- Image Upload -->
                        <div class="col-sm-12 mb-3">
                            <label>Image</label> 
                            <div class="input-group">
                                <input id="image" class="form-control lfm" name="image" type="text" required>
                                <span class="input-group-btn">
                                    <a data-input="image" data-preview="image-holder" class="btn btn-primary lfm">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                            </div>
                            <div id="image-holder" style="margin-top:15px;max-height:100px;"></div>
                        </div>

                        <!-- Logo Upload -->
                        <div class="col-sm-12 mb-3">
                            <label>Logo</label> 
                            <div class="input-group">
                                <input id="logo" class="form-control lfm" name="logo" type="text" required>
                                <span class="input-group-btn">
                                    <a data-input="logo" data-preview="logo-holder" class="btn btn-primary lfm">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                            </div>
                            <div id="logo-holder" style="margin-top:15px;max-height:100px;"></div>
                        </div>

                        <!-- Tags (if applicable) -->
                        <div class="col-sm-12 mb-3">
                            <div class="form-group">
                                <label for="tags">Select Tags</label>
                                <div class="scrollable-checkboxes">
                                    @foreach($tags as $tag)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                                id="tag{{ $tag->id }}"
                                                @if(isset($selectedTags) && in_array($tag->id, $selectedTags)) checked @endif>
                                            <label class="form-check-label" for="tag{{ $tag->id }}">
                                                <span class="tag-name">{{ $tag->name }}</span> 
                                                <small class="tag-description">{{ $tag->description }}</small>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-sm-8 mt-2">
                            <button class="btn btn-block btn-primary btn-user" type="submit">Add Testimonial</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<!-- Styling for form -->
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
        padding: 10px 28px;
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
        $('.lfm').filemanager('file', {prefix: route_prefix});
    });
</script>
@endpush
