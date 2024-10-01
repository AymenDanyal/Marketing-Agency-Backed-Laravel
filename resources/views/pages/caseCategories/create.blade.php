@extends('layouts.master')

@section('content')
<div class="container-fluid card shadow mb-4">
    <h1 class="heading">Add Case Category</h1>

    <form action="{{ route('case-categories.store') }}" method="POST" class="user">
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
            <div class="mb-3 col-sm-12">
                <label for="name">Category Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" id="name" required placeholder="Enter Category Name">
            </div>
            <div class="mb-3 col-sm-12">
                <label for="url">Website Link <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="url" id="name" required placeholder="Enter Category Name">
            </div>

            <div class="col-sm-12 mb-3">
                <label for="url">Logo Image<span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a class="lfm btn btn-primary" data-input="logo"
                            data-preview="desktop_holder">
                            <i class="fa fa-picture-o"></i> Logo
                        </a>
                    </span>
                    <input id="logo" class="form-control" type="text"
                        name="logo" >
                </div>
                <div id="desktop_holder" style="margin-top: 15px;">
                    
                    <img class="mt-3" id="logo_preview" src=""
                        style="width: 100%">
                    
                </div>
            </div>

            <div class="mb-3 col-sm-12">
                <label for="slug">Slug <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="slug" id="slug" required placeholder="Enter Category Slug" disabled>
            </div>

            <div class="mb-3 col-sm-12">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        
        var route_prefix = "{{ url('/laravel-filemanager') }}";
        $('.lfm').filemanager( {prefix: route_prefix});
        const slugify = str =>
            str
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');

        $('#name').keyup(function() {
            const slugInput = $('#slug');
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
