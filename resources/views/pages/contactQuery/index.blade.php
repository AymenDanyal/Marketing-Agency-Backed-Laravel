@extends('layouts.master')

@section('content')

<div class="container-fluid">
    
    <div class="card mb-4 shadow">
        <h1 class="heading">Contact Queries</h1>
        <div class="card-body">
            <div class="table-responsive">
                <table cellspacing="0" class="table table-bordered" id="contactQueries" width="100%">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Number</th>
                            <th>Company</th>
                            <th>Query</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="data_here">
                        @if($queries && $queries->isNotEmpty())
                            @foreach($queries as $key => $contact)
                            <tr id="query-{{ $contact['id'] }}">
                                <th>{{ $key + 1 }}</th>
                                <td>{{ $contact['name'] }}</td>
                                <td>{{ $contact['email'] }}</td>
                                <td>{{ $contact['number'] }}</td>
                                <td>{{ $contact['company'] }}</td>
                                <td>{{ $contact['query'] }}</td>
                                <td>{{ date('d/m/Y H:i:s', strtotime($contact['date_created'])) }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm delete-button" data-id="{{ $contact['id'] }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="8" rowspan="10">
                                <h1 class="text-center text-danger">No Contact Queries Yet.</h1>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
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

    .heading {
        padding: 11px 17px;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#contactQueries').DataTable({
            "paging": true,
            "searching": true,
            "info": true
        });

        // AJAX Delete Functionality
        $('.delete-button').click(function(e) {
            e.preventDefault();
            var contactId = $(this).data('id');
            var url = '{{ route('contact-queries.destroy', ':id') }}';
            url = url.replace(':id', contactId);

            if(confirm('Are you sure you want to delete this query?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if(response.success) {
                            $('#query-' + contactId).remove();
                            alert('Query deleted successfully!');
                        } else {
                            alert('Failed to delete the query. Please try again.');
                        }
                    },
                    error: function(response) {
                        alert('Error occurred. Please try again.');
                    }
                });
            }
        });
    });
</script>
@endpush
