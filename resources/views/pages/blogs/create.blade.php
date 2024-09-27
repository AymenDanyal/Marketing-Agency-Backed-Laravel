@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-left">
                    <h1 class="">Add Blog</h1>
                </div>
                <form action="{{ route('blogs.store') }}" class="user" enctype="multipart/form-data" method="post">
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
                        <div class="mb-3 col-sm-6">
                            <input class="form-control" name="title" required placeholder="Blog Title">
                        </div>
                        <div class="mb-3 col-sm-6">
                            <input class="form-control" name="slug" disabled required placeholder="Blog Slug" >
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label>Please Select Category</label>
                            <select class="form-control" name="cat_id" required>
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($cats as $key => $cat)
                                    <option value="{{ $cat->id }}">
                                        {{ $cat->category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-sm-12">
                            <div class="row">
                                <!-- Desktop Banner -->
                                <div class="col-md-4 mt-4">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a class="lfm btn btn-primary" data-input="desktop_banner"
                                                data-preview="desktop_holder">
                                                <i class="fa fa-picture-o"></i> Please Select Desktop Banner
                                            </a>
                                        </span>
                                        <input id="desktop_banner" class="form-control" type="text"
                                            name="desktop_banner" >
                                    </div>
                                    <div id="desktop_holder" style="margin-top: 15px;">
                                       
                                        <img class="mt-3" id="desktop_banner_preview" src=""
                                            style="width: 100%">
                                      
                                    </div>
                                </div>

                                <!-- Mobile Banner -->
                                <div class="col-md-4 mt-4">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a class="lfm btn btn-primary" data-input="mob_banner"
                                                data-preview="mob_banner_holder">
                                                <i class="fa fa-picture-o"></i> Please Select Mobile Banner
                                            </a>
                                        </span>
                                        <input id="mob_banner" class="form-control" type="text" name="mob_banner" >
                                    </div>
                                    <div id="mob_banner_holder" style="margin-top: 15px;">
                                       
                                        <img class="mt-3" id="mob_banner_preview" src=""
                                            style="width: 100%">
                                       
                                    </div>
                                </div>

                                <!-- Thumbnail -->
                                <div class="col-md-4 mt-4">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a class="lfm btn btn-primary" data-input="thumbnail"
                                                data-preview="thumbnail_holder">
                                                <i class="fa fa-picture-o"></i> Please Select Thumbnail
                                            </a>
                                        </span>
                                        <input id="thumbnail" class="form-control" type="text" name="thumbnail" >
                                    </div>
                                    <div id="thumbnail_holder" style="margin-top: 15px; ">
                                       
                                        <img class="mt-3" id="thumbnail_preview_img" src=""
                                            style="width: 100%">
                                       
                                    </div>
                                </div>
                            </div>

                        </div>



                        <div class="mb-3 col-sm-12">
                            <label>Blog Summary 
                                <small>Please write a short summary of the blog</small>
                            </label> 
                            <textarea class="form-control" name="summary" required></textarea>
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label>Blog Content</label> 
                            <textarea class="form-control" name="content" required id="blog_content"></textarea>
                        </div>
                        <div class="mb-3 col-sm-12">
                            <button class="btn btn-block btn-primary" type="submit">Submit</button>
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


        if ($("#blog_content").length > 0) {
            CKEDITOR.replace('blog_content');
            CKEDITOR.instances['blog_content'].on('paste', function(event) {
                const pastedData = event.data.dataValue;
                if (isImage(pastedData)) {
                    const base64Image = toBase64(pastedData);
                    CKEDITOR.instances['blog_content'].insertHtml(`<img src="${base64Image}" />`);
                }
            });

            function isImage(data) {
                return data.startsWith('data:image/');
            }

            function toBase64(data) {
                return data;  // Note: In actual usage, implement proper conversion
            }
        }

        const slugify = str =>
            str
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');

        $('input[name="title"]').keyup(function(event) {
            if ($(this).val().length > 0) {
                $('input[name="slug"]').val(slugify($(this).val()));
                $('input[name="slug"]').removeAttr('disabled');
            } else {
                $('input[name="slug"]').val('');
                $('input[name="slug"]').attr('disabled', 'disabled');
            }
        });
    });
</script>
@endpush
