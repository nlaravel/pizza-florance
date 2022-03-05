@extends('front_layout.main')
@push('style')
    <style>
    </style>
@endpush
@section('content')
    <section class="tearm-section">
        <div class="container">
           <p>{!! $terms->description !!}</p>
        </div>
    </section>
    @push('scripts')
        <script>
        </script>
    @endpush
@stop