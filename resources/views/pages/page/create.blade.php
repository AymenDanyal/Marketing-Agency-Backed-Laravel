@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-left">
                    <h1 class="h4 mb-4 text-gray-900">Add Page</h1>
                </div>
                <form action="{{ route('pages.store') }}" class="user" method="POST">
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
                    <div class="form-group">
                        <label for="tags" class="font-weight-bold">Select Tags</label>
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
                    
                    

                    <div class="row form-group">
                        <div class="col-sm-12 mb-3">
                            <label>Page Name</label> 
                            <input name="name" class="form-control" placeholder="Page Name" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label>Page Slug</label> 
                            <input name="slug" class="form-control" placeholder="Page Slug" required>
                        </div>
                        <div class="col-sm-8 mt-2">
                            <button class="btn btn-block btn-primary btn-user" type="submit">Add Page</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

    
<style>
    /* Styling for the form group label */
    .font-weight-bold {
        font-size: 1.1rem;
        margin-bottom: 10px;
        display: block;
        color: #333;
    }

    /* Scrollable container */
    .scrollable-checkboxes {
        max-height: 200px; /* Limits height to 200px */
        overflow-y: scroll; /* Enable scrolling if content overflows */
        border: 1px solid #ddd; /* Light gray border */
        border-radius: 4px; /* Rounded corners */
        padding: 10px; /* Padding inside the container */
        background-color: #fff; /* Light background for better contrast */
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    /* Each checkbox item */
    .form-check {
        padding: 8px 0; /* Spacing between checkboxes */
        border-bottom: 1px solid #eaeaea;
    }

    /* Remove border on last item */
    .form-check:last-child {
        border-bottom: none;
    }

    /* Label styles */
    .form-check-label {
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    /* Checkbox styling */
    .form-check-input {
        margin-right: 10px;
    }

    /* Tag name and description styling */
    .tag-name {
        font-weight: 600;
        color: #333;
    }

    .tag-description {
        margin-left: 10px;
        color: #888;
        font-size: 0.85rem;
    }

    /* Hover effect */
    .form-check:hover {
        background-color: #f1f1f1;
        transition: background-color 0.3s ease;
    }

    /* Custom scrollbar for the scrollable div */
    .scrollable-checkboxes::-webkit-scrollbar {
        width: 8px;
    }

    .scrollable-checkboxes::-webkit-scrollbar-thumb {
        background-color: #ccc; /* Customize scrollbar thumb */
        border-radius: 10px;
    }

    .scrollable-checkboxes::-webkit-scrollbar-track {
        background-color: #f9f9f9; /* Customize scrollbar track */
    }

</style>
