@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <h1 class="h3 mb-2 text-gray-800">Product Categories</h1>
        </div>
        <div class="col-md-4">
            <a class="btn btn-success btn-block" href="{{ route('product-cats.create') }}">Add</a>
        </div>
    </div>
    <div class="card mb-4 shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table cellspacing="0" class="table table-bordered" id="dataTable" width="100%">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Is Parent</th>
                            <th>Parent Category</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Is Parent</th>
                            <th>Parent Category</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody id="sortable">
                        @foreach($cats as $key => $cat)
                        <tr data-id="{{ $cat->id }}" data-order="{{ $key + 1 }}">
                            <th>{{ $key + 1 }}</th>
                            <td>{{ $cat->category }}</td>
                            <td>{{ $cat->description }}</td>
                            <td>{{ $cat->is_parent == 1 ? 'Yes' : 'No' }}</td>
                            <td>{{ $cat->parent_id }}</td>
                            <td>{{ $cat->slug }}</td>
                            <td colspan="2">
                                <a class="btn btn-success" href="{{ route('product-cats.edit', $cat->id) }}">Edit</a>
                                <a class="btn btn-danger" onclick="AsktoDel({{ $cat->id }})">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
    $(function () {
        $("#sortable").sortable({
            axis: 'y',
            update: function (event, ui) {
                var data = $(this).sortable('serialize');
                console.log('data', data);
                console.log('event', event);
                console.log('ui', ui);

                let my_tr = ui.item[0];
                console.log('my_tr', my_tr)

                let sort_by = $(my_tr).attr('data-order');
                let id = $(my_tr).attr('data-id');

                console.log('sort = ', sort_by);
                console.log('id = ', id);

                let org = event.target.children;
                console.log(org);
                let pos_id = [];
                $.each(org, function (index, val) {
                    pos_id.push(
                        {
                            'order': index + 1,
                            'id': $(val).attr('data-id')
                        }
                    )
                });

                console.log(pos_id);

                $.ajax({
                    data: { pos_id: pos_id },
                    type: 'POST',
                    url: "{{ route('product-cats.sort') }}",
                });
            }
        });
    });

    function AsktoDel(id) {
        console.log("ID deleted is" + id)
        swal({
            title: "Are you sure you want to delete this Category",
            text: "Once deleted, you will not be able to recover this Category",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "{{ route('product-cats.destroy', '') }}/" + id,
                    type: 'GET',
                    success: function (data) {
                        swal("Poof! Your Category has been deleted!", {
                            icon: "success",
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 800);
                    }
                });
            } else {
                swal("Your Category is safe!");
            }
        });
    }
</script>
@endpush
