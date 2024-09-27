@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-left">
                    <h1 class="h4 mb-4 text-gray-900">Edit Case Study</h1>
                </div>
                <form action="{{ route('case-studies.update', ['id' => $caseStudy->id]) }}" method="POST" class="user"
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

                    <input type="hidden" name="id" value="{{ $caseStudy->id }}">

                    <div class="row form-group">
                        <div class="mb-3 col-sm-6">
                            <input name="title" class="form-control" placeholder="Case Study Title" required
                                value="{{ $caseStudy->title }}">
                        </div>
                        <div class="mb-3 col-sm-6">
                            <input name="slug" class="form-control" placeholder="Case Study Slug" required
                                value="{{ $caseStudy->slug }}">
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label for="case_cat">Please Select Category</label>
                            <select id="case_cat" class="form-control" name="cat_id" required>
                                <option value="" disabled>Select Category</option>
                                @foreach($cats as $cat)
                                <option value="{{ $cat->id }}" {{ $caseStudy->cat_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
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
                                            name="desktop_banner" value="{{ $caseStudy->desktop_banner }}">
                                    </div>
                                    <div id="desktop_holder" style="margin-top: 15px;">
                                        @if($caseStudy->desktop_banner)
                                        <img class="mt-3" id="desktop_banner_preview" src="{{ $caseStudy->desktop_banner }}"
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
                                        <input id="mob_banner" class="form-control" type="text" name="mob_banner" value="{{ $caseStudy->mob_banner }}">
                                    </div>
                                    <div id="mob_banner_holder" style="margin-top: 15px;">
                                        @if($caseStudy->mob_banner)
                                        <img class="mt-3" id="mob_banner_preview" src="{{ $caseStudy->mob_banner }}"
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
                                        <input id="thumbnail" class="form-control" type="text" name="thumbnail" value="{{ $caseStudy->thumbnail }}">
                                    </div>
                                    <div id="thumbnail_holder" style="margin-top: 15px;">
                                        @if($caseStudy->thumbnail)
                                        <img class="mt-3" id="thumbnail_preview_img" src="{{ $caseStudy->thumbnail }}"
                                            style="width: 100%">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 col-sm-12">
                            <label for="case_summary">Case Study Summary <small>Please write a short summary of the case study</small></label>
                            <textarea id="case_summary" class="form-control" name="summary"
                                required>{{ $caseStudy->summary }}</textarea>
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label for="case_content">Case Study Content</label>
                            <textarea id="case_content" class="form-control" name="content"
                                required>{{ $caseStudy->content }}</textarea>
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
        var route_prefix = "{{ url('/laravel-filemanager') }}";
        $('.lfm').filemanager('image', {prefix: route_prefix});

        // Initialize CKEditor for case study content
        if ($("#case_content").length > 0) {
            CKEDITOR.replace('case_content');
        }
    });
</script>
@endpush
