@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <iframe src="{{ url('/laravel-filemanager')}} " style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
</div>
@endsection

@push('scripts')
<script type="text/javascript">

</script>
@endpush