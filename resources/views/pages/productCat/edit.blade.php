@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-left">
                    <h1 class="h4 mb-4 text-gray-900">Edit Product Category</h1>
                </div>
                <form action="{{ route('product-cats.update', $cat->id) }}" class="user" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <input name="id" value="{{ $cat->id }}" type="hidden">
                    <div class="row form-group">
                        <div class="col-sm-12 mb-3">
                            <label>Category Name</label>
                            <input name="cat_name" class="form-control" placeholder="Product Category Name" value="{{ $cat->category }}" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label>Category Description</label>
                            <input name="description" class="form-control" placeholder="Product Category Description" value="{{ $cat->description }}">
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label>Category Slug</label>
                            <input name="cat_slug" class="form-control" placeholder="Product Category Slug" value="{{ $cat->slug }}" required disabled>
                        </div>
                        <div class="mb-3 col-sm-4">
                            <label>Category Image</label> 
                            <input class="form-control" value="{{ $cat->image }}" name="mob_banner" required type="file">
                        </div>
                        <div class="col-sm-12 mb-3 customCheckbox" style="display:flex;align-items:center;gap:.5rem">
                            <label style="margin-bottom:0">Is Parent</label>
                            <input name="is_parent" class="form-control checkbox" style="width:max-content" type="checkbox" {{ $cat->is_parent == 1 ? 'checked' : '' }}>
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label>Meta Footer</label>
                            <textarea class="form-control" name="meta_footer"
                                id="meta_footer">{{ $cat->meta_footer }}</textarea>
                        </div>

                        <div class="mb-3 col-sm-12">
                            <label>Meta Title</label> 
                            <textarea id="meta_title" name="meta_title"  class="form-control"
                                placeholder="Meta Title" required>{{ $cat->meta_title }}</textarea>
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label>Meta Description</label> 
                            <textarea id="meta_description" name="meta_description" class="form-control"
                                placeholder="Meta Description" required>{{ $cat->meta_description }}</textarea>
                        </div>
                        <div class="col-sm-12 mb-3 form-select" style="display:none" id="sub_cat">
                            <select id="sub_cats" name="parent_id">
                                @if(!empty($parent_cats))
                                    @foreach($parent_cats as $parent_cat)
                                        <option value="{{ $parent_cat->id }}" {{ $cat->parent_id == $parent_cat->id ? 'selected' : '' }}>
                                            {{ $parent_cat->category }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="">No subcategories available</option>
                                @endif
                            </select>
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

@push('style')
<style>
    .add-button {
        width: 150px;
        position: absolute;
        right: 25px;
        top: 43px;
        border-radius: 4px;
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript">
    const slugify = str =>
        str
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, '')
        .replace(/[\s_-]+/g, '-')
        .replace(/^-+|-+$/g, '');
    

    $('input[name="cat_name"]').keyup(function(event) {
        if ($(this).val().length > 0) {
            $('input[name="cat_slug"]').val(slugify($(this).val()));
            $('input[name="cat_slug"]').removeAttr('disabled');
        } else {
            $('input[name="cat_slug"]').val('');
            $('input[name="cat_slug"]').attr('disabled', 'disabled');
        }
    });

    $('input[name="is_parent"]').change(function() {
        if ($(this).is(':checked')) {
            $('#sub_cat').hide();
        } else {
            $('#sub_cat').show();
        }
    });

    if($("#meta_footer").length > 0){
        CKEDITOR.replace('meta_footer');
    }
    // Trigger the change event on page load to ensure the initial state is reflected
    $('input[name="is_parent"]').change();
</script>
@endpush
