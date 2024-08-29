@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-left">
                    <h1 class="h4 mb-4 text-gray-900">Edit Product</h1>
                </div>
                <form action="{{route('products.update',['id' => $product->id])}}" class="user"
                    enctype="multipart/form-data" method="POST">
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
                    <input name="id" value="{{$product['id']}}" type="hidden">

                    <div class="row form-group">
                        <div class="mb-3 col-sm-6">
                            <input name="title" value="{{$product['title']}}" class="form-control"
                                placeholder="Product Title" required>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <input name="slug" value="{{$product['slug']}}" class="form-control"
                                placeholder="Product Slug" required>
                        </div>

                        <div class="mb-3 col-sm-12">
                            <label>Please Select Category</label>
                            <select class="form-control" name="cat_id" required>
                                <option value="" disabled>Select Category</option>
                                @foreach($cats as $cat)
                                <option value="{{$cat->id}}" {{$product['cat_id']==$cat->id ? 'selected' :
                                    ''}}>{{$cat->category}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-sm-4">
                            <label>Please Select Image</label>
                            <input name="image" class="form-control" type="file">
                            <input name="test" value="{{$product['image']}}" type="hidden">
                            @if($product['image'])
                            <img class="mt-3" id="product_image_preview" src="{{$product['image']}}" style="width:100%">
                            @endif
                        </div>

                        <div class="mb-3 col-sm-4">
                            <label>Please Select File</label>
                            <input name="file" class="form-control" type="file">
                            @if($product['file'])
                            <p class="mt-3" id="product_file_display">{{$product['file']}}</p>
                            @endif
                        </div>

                        <div class="mb-3 col-sm-12">
                            <label>Product Summary <small>Please write a short summary of the product</small></label>
                            <textarea class="form-control" name="summary"
                                required>{{trim($product['summary'])}}</textarea>
                        </div>

                        <div class="mb-3 col-sm-12">
                            <label>Product Content</label>
                            <textarea class="form-control" name="description" id="description"
                                required>{{trim($product['description'])}}</textarea>
                        </div>

                        <div class="mb-3 col-sm-12">
                            <label>Meta Footer</label>
                            <textarea class="form-control" name="meta_footer"
                                id="meta_footer">{{$product['meta_footer']}}</textarea>
                        </div>

                        <div class="mb-3 col-sm-12">
                            <label>Meta Title</label> 
                            <textarea id="meta_title" name="meta_title" class="form-control"
                                placeholder="Meta Title" required>{{$product['meta_title']}}</textarea>
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label>Meta Description</label> 
                            <textarea id="meta_description" name="meta_description" class="form-control"
                                placeholder="Meta Description" required>{{$product['meta_description']}}</textarea>
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
    jQuery(document).ready(function($) {
        // Preview image before upload
        $('input[name="product_image"]').change(function (e) {
            const [file] = e.target.files;
            if (file) {
                $('#product_image_preview').prop('src', URL.createObjectURL(file));
            }
        });

        // CKEditor for product description
        if($("#description").length > 0){
            CKEDITOR.replace('description');
        }
        if($("#meta_footer").length > 0){
            CKEDITOR.replace('meta_footer');
        }
        
        

        // Slugify product name
        const slugify = str =>
            str
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');

        $('input[name="title"]').keyup(function(event) {
            const productName = $(this).val();
            const productSlugInput = $('input[name="slug"]');
            
            if(productName.length > 0){
                productSlugInput.val(slugify(productName));
                productSlugInput.removeAttr('disabled');
            } else {
                productSlugInput.val('');
                productSlugInput.attr('disabled', 'disabled');
            }
        });
    });
</script>
@endpush