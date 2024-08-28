@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-left">
                    <h1 class="h4 mb-4 text-gray-900">Edit Blog Category</h1>
                </div>
                <form action="{{ route('blogCat.update', ['id' => $cat->id]) }}" class="user" method="POST">
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
                    <input name="id" value="{{$cat->id}}" type="hidden">
                    <div class="row form-group">
                        <div class="col-sm-12 mb-3">
                            <label>Category Name</label> 
                            <input name="cat_name" value="{{$cat->category}}" class="form-control" placeholder="Blog Category Name" required>
                        </div>
                        <div class="col-sm-12 mb-3"><label>Category Slug</label> 
                            <input name="cat_slug" value="{{$cat->slug }}" class="form-control" placeholder="Blog Category Slug" required disabled>
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





    $('input[name="cat_name"]').keyup(function(event) {



        if ($(this).val().length > 0) {



            $('input[name="cat_slug"]').val(slugify($(this).val()));

            $('input[name="cat_slug"]').removeAttr('disabled');



        } else {

            $('input[name="cat_slug"]').val('');



            $('input[name="cat_slug"]').attr('disabled', 'disabled');



        }



    });
</script>
@endpush