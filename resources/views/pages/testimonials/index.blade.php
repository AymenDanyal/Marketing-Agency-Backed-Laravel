@extends('layouts.master')

@section('content')
<div class="container-fluid card shadow mb-4">
    <h1 class="heading">Testimonials</h1>

    <a href="{{ route('testimonials.create') }}" class="btn btn-primary add-button">Add Testimonial</a>

    <!-- DataTable -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="testimonialsTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Person</th>
                            <th>Comment</th>
                            <th>Image</th>
                            <th>Logo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno = 1; // Initialize S.no
                        @endphp
                        @foreach($testimonials as $testimonial)
                        <tr>
                            <td>{{ $sno }}</td>
                            <td>{{ $testimonial->person }}</td>
                            <td>{{ Str::limit($testimonial->comment, 50) }}</td>
                            <td>
                                @if($testimonial->image)
                                    <img src="{{ asset($testimonial->image) }}" alt="Image" width="50">
                                @else
                                    No image
                                @endif
                            </td>
                            <td>
                                @if($testimonial->logo)
                                    <img src="{{ asset( $testimonial->logo) }}" alt="Logo" width="50">
                                @else
                                    No logo
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="btn btn-success">Edit</a>
                                <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @php
                            $sno++; // Increment S.no
                        @endphp
                        @endforeach
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
        padding: 22px 0px;
    }
    .table img {
        border-radius: 4px;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#testimonialsTable').DataTable({
            "paging": true,
            "searching": true,
            "info": true
        });
    });
</script>
@endpush
