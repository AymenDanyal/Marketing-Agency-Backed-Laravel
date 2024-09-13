@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-left">
                    <h1 class="h4 mb-4 text-gray-900">Edit Blog</h1>
                </div>
                <form action="{{ route('blogs.update', ['id' => $blog->id]) }}" method="POST" class="user"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <input type="hidden" name="id" value="{{ $blog->id }}">

                    <div class="row form-group">
                        <div class="mb-3 col-sm-6">
                            <input name="title" class="form-control" placeholder="Blog Title" required
                                value="{{ $blog->title }}">
                        </div>
                        <div class="mb-3 col-sm-6">
                            <input name="slug" class="form-control" placeholder="Blog Slug" required
                                value="{{ $blog->slug }}">
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label for="blog_cat">Please Select Category</label>
                            <select id="blog_cat" class="form-control" name="cat_id" required>
                                <option value="" disabled>Select Category</option>
                                @foreach($cats as $cat)
                                <option value="{{ $cat->id }}" {{ $blog->cat_id == $cat->id ? 'selected' : '' }}>
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
                                            name="desktop_banner" value={{ $blog->desktop_banner }}>
                                    </div>
                                    <div id="desktop_holder" style="margin-top: 15px;">
                                        @if($blog->desktop_banner)
                                        <img class="mt-3" id="desktop_banner_preview" src="{{ $blog->desktop_banner}}"
                                            style="width: 100%">
                                        @endif
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
                                        <input id="mob_banner" class="form-control" type="text" name="mob_banner" value={{ $blog->mob_banner}}>
                                    </div>
                                    <div id="mob_banner_holder" style="margin-top: 15px;">
                                        @if($blog->mob_banner)
                                        <img class="mt-3" id="mob_banner_preview" src="{{ $blog->mob_banner}}"
                                            style="width: 100%">
                                        @endif
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
                                        <input id="thumbnail" class="form-control" type="text" name="thumbnail" value={{ $blog->thumbnail }}>
                                    </div>
                                    <div id="thumbnail_holder" style="margin-top: 15px; ">
                                        @if($blog->thumbnail)
                                        <img class="mt-3" id="thumbnail_preview_img" src="{{ $blog->thumbnail}}"
                                            style="width: 100%">
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>







                        <div class="mb-3 col-sm-12">
                            <label for="blog_summary">Blog Summary <small>Please write a short summary of the
                                    blog</small></label>
                            <textarea id="blog_summary" class="form-control" name="summary"
                                required>{{ $blog->summary }}</textarea>
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label for="blog_content">Blog Content</label>
                            <textarea id="blog_content" class="form-control" name="content"
                                required>{{ $blog->content }}</textarea>
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

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // Preview file inputs

        var route_prefix = "/laravel-filemanager";
        $('.lfm').filemanager('image', {prefix: route_prefix});


        $('input[type="file"]').change(function(e) {
            const [file] = $(this).prop('files');
            const id_name = $(this).attr('id') + '_preview';

            if (file) {
                $('#' + id_name).prop('src', URL.createObjectURL(file));
            }
        });

        // Initialize CKEditor for blog content
        if ($("#blog_content").length > 0) {
            CKEDITOR.replace('blog_content');
        }

        // Generate blog slug from blog name
        const slugify = str =>
            str.toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');

        $('input[name="blog_name"]').keyup(function() {
            const slugInput = $('input[name="blog_slug"]');
            if ($(this).val().length > 0) {
                slugInput.val(slugify($(this).val()));
                slugInput.removeAttr('disabled');
            } else {
                slugInput.val('');
                slugInput.attr('disabled', 'disabled');
            }
        });
    });
</script>
@endpush