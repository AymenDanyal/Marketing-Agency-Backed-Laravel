@extends('layouts.master')

@section('content')
<div class="container-fluid card shadow mb-4">
    <h1 class="heading">Case Studies</h1>

    <a href="{{ route('case-studies.create') }}" class="btn btn-primary add-button">Add Case Study</a>

    <!-- DataTable -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="caseStudiesTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Slug</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Thumbnail</th>
                            <th>Desktop Banner</th>
                            <th>Mobile Banner</th>
                            <th>Summary</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno = 1; // Initialize S.no
                        @endphp
                        @foreach($caseStudies as $caseStudy)
                        <tr>
                            <td>{{ $sno }}</td> 
                            <td>{{ $caseStudy->slug }}</td>
                            <td>{{ $caseStudy->title }}</td>
                            <td>{{  $caseStudy->category->name }}</td>
                            <td>
                                @if($caseStudy->thumbnail)
                                    <img src="{{ $caseStudy->thumbnail }}" alt="Thumbnail" width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                @if($caseStudy->desktop_banner)
                                    <img src="{{ $caseStudy->desktop_banner }}" alt="Desktop Banner" width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                @if($caseStudy->mob_banner)
                                    <img src="{{ $caseStudy->mob_banner }}" alt="Mobile Banner" width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $caseStudy->summary }}</td>
                            <td>
                                <a href="{{ route('case-studies.edit', $caseStudy->id) }}" class="btn btn-success">Edit</a>
                                <form action="{{ route('case-studies.destroy', $caseStudy->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this case study?');">
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
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#caseStudiesTable').DataTable({
            "paging": true,
            "searching": true,
            "info": true
        });
    });
</script>
@endpush
