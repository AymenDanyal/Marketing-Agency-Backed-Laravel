@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-left">
                    <h1>Add Product</h1>
                </div>
                <form action="{{route('products.store')}}" class="user" enctype="multipart/form-data" method="POST">
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
                            <input class="form-control" name="title" placeholder="Product Title" required>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <input class="form-control" name="slug" placeholder="Product Slug" required disabled></div>
                        <div class="mb-3 col-sm-12"><label>Please Select Category</label> <select class="form-control"
                                name="cat_id" required>
                                <option value="false" disabled>Select Category</option>
                                @foreach($cats as $key=>$cat)
                                <option value="{{$cat->id}}">
                                    {{$cat->category}}
                                </option>
                                @endforeach
                            </select></div>
                        <div class="mb-3 col-sm-4"><label>Please Select Product Image</label> 
                            <input class="form-control" name="image" type="file">
                        </div>
                        <div class="mb-3 col-sm-4">
                            <label>Please Select Product File</label>
                             <input class="form-control" name="file" type="file" accept="application/pdf">
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label>Product Summary 
                                <small>Please write short summary of product</small>
                            </label> 
                            <textarea class="form-control" name="summary" required></textarea>
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label>Product Content</label> 
                            <textarea class="form-control" name="description" required id="description"></textarea>
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label>Meta Footer</label> 
                            <textarea class="form-control" name="meta_footer" required id="meta_footer"></textarea>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <input class="form-control" name="meta_title" placeholder="Meta Title" required></div>
                        <div class="mb-3 col-sm-6">
                            <input class="form-control" name="meta_description" placeholder="Meta Description" required></div>
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

        if($("#description").length > 0){
         CKEDITOR.replace( 'description' );
        }

        if($("#meta_footer").length > 0){
         CKEDITOR.replace( 'meta_footer' );
        }
    });
        const slugify = str =>str
    .toLowerCase()
    .trim()
    .replace(/[^\w\s-]/g, '')
    .replace(/[\s_-]+/g, '-')
    .replace(/^-+|-+$/g, '');





    $('input[name="title"]').keyup(function(event) {
        if($(this).val().length>0){
            $('input[name="slug"]').val( slugify($(this).val())  );
            $('input[name="slug"]').removeAttr('disabled');

        }else{
            $('input[name="slug"]').val('');
            $('input[name="slug"]').attr('disabled','disabled');

        }   

    });
</script>
@endpush