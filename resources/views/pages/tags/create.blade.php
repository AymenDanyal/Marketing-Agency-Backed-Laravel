@extends('layouts.master')

@section('content')
<div class="container-fluid">
    
    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-left">
                    <h1 class="h4 mb-4 text-gray-900">Add Tag</h1>
                </div>
                <form action="{{ route('tags.store') }}" class="user" method="POST">
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
                        <div class="col-sm-12 mb-3">
                            <label>Tag Name</label> 
                            <input name="name" class="form-control" placeholder="Tag Name" required>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label>Description</label> 
                            <textarea name="description" class="form-control" placeholder="Tag Description" required></textarea>
                        </div>
                        <div class="col-sm-8 mt-2">
                            <button class="btn btn-block btn-primary btn-user" type="submit">Add Tag</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
