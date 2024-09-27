@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-left">
                    <h1 class="h4 mb-4 text-gray-900">Add Job</h1>
                </div>
                <form action="{{ route('jobs.store') }}" class="user" enctype="multipart/form-data" method="POST">
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
                            <label>Job Title</label> 
                            <input name="title" class="form-control" placeholder="Job Title" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label>Description</label> 
                            <textarea name="description" class="form-control" placeholder="Job Description" required></textarea>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a class="lfm btn btn-primary" data-input="Image"
                                        data-preview="desktop_holder">
                                        <i class="fa fa-picture-o"></i>Image
                                    </a>
                                </span>
                                <input id="Image" class="form-control" type="text"
                                    name="image" >
                            </div>
                            <div id="desktop_holder" style="margin-top: 15px;">
                               
                                <img class="mt-3" id="image_preview" src=""
                                    style="width: 100%">
                              
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-sm-8 mt-2">
                            <button class="btn btn-block btn-primary btn-user" type="submit">Add Job</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    jQuery(document).ready(function($) {

        var route_prefix = "{{ url('/laravel-filemanager') }}";
        $('.lfm').filemanager('image', {prefix: route_prefix});
    });
    </script>
@endpush
