@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-left">
                    <h1>Add Product Category</h1>
                </div>
                <form action="{{ route('product-cats.store') }}" class="user" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row form-group">
                        <div class="col-sm-12 mb-3">
                            <input class="form-control" name="cat_name" placeholder="Product Category Name" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <input class="form-control" name="description" placeholder="Product Category Description" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <input class="form-control" name="cat_slug" placeholder="Product Category Slug" required disabled>
                        </div>
                        <div class="col-sm-12 mb-3 customCheckbox" style="display:flex;align-items:center;gap:.5rem">
                            <label style="margin-bottom:0">Is Parent</label>
                            <input class="form-control checkbox" name="is_parent" checked style="width:max-content" type="checkbox">
                        </div>
                        <div class="col-sm-12 mb-3 form-select" style="display:none" id="sub_cat">
                            <select id="sub_cats" name="parent_id">
                                @if(!empty($parent_cats))
                                    <option value="">Select Parent Category</option>
                                    @foreach($parent_cats as $parent_cat)
                                        <option value="{{ $parent_cat->id }}">
                                            {{ $parent_cat->category }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="">No subcategories available</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-8 mt-2">
                            <button class="btn btn-block btn-primary btn-user" type="submit">Add Category</button>
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

    $('input[name="cat_name"]').keyup(function(event) {
        if ($(this).val().length > 0) {
            $('input[name="cat_slug"]').val(slugify($(this).val()));
            $('input[name="cat_slug"]').removeAttr('disabled');
        } else {
            $('input[name="cat_slug"]').val('');
            $('input[name="cat_slug"]').attr('disabled', 'disabled');
        }
    });

    $(document).ready(function() {
        $('input[name="is_parent"]').change(function() {
            if ($(this).is(':checked')) {
                $('#sub_cat').hide();
            } else {
                $('#sub_cat').show();
            }
        });
    });
</script>
@endpush
