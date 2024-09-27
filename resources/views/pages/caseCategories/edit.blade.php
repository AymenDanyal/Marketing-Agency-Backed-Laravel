@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-left">
                    <h1 class="h4 mb-4 text-gray-900">Edit Case Category</h1>
                </div>
                <form action="{{ route('case-categories.update', ['id' => $category->id]) }}" class="user" method="POST" enctype="multipart/form-data">
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
                    <input name="id" value="{{ $category->id }}" type="hidden">
                    <div class="row form-group">
                        <div class="col-sm-12 mb-3">
                            <label>Category Name</label> 
                            <input name="name" value="{{ $category->name }}" class="form-control" placeholder="Enter Case Category Name" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label>Category Logo</label> 
                            <input  name="logo" class="lfm form-control" placeholder="Upload Logo">
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label>Logo</label> 
                            <input name="url" value="{{ $category->url }}" class="form-control" placeholder="Enter URL" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label>Category Slug</label> 
                            <input name="slug" value="{{ $category->slug }}" class="form-control" placeholder="Case Category Slug" required disabled>
                        </div>
                        <div class="col-sm-8 mt-2">
                            <button class="btn btn-block btn-primary btn-user" type="submit">Edit Category</button>
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
    const slugify = str =>
        str
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, '')
        .replace(/[\s_-]+/g, '-')
        .replace(/^-+|-+$/g, '');

    $('input[name="name"]').keyup(function(event) {
        if ($(this).val().length > 0) {
            $('input[name="slug"]').val(slugify($(this).val()));
            $('input[name="slug"]').removeAttr('disabled');
        } else {
            $('input[name="slug"]').val('');
            $('input[name="slug"]').attr('disabled', 'disabled');
        }
    });
</script>
@endpush
