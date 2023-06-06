@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Dashboard')

@section('content')
<div class="row">

    {{-- Start Lise Statictics --}}
    @livewire('backend.dashboard.list-statistic')
    {{-- End Lise Statictics --}}

</div>

{{-- START CHART --}}
<div class="row">

    <!-- Line Charts -->
    @livewire('backend.dashboard.line-chart')

    <!-- /Line Charts -->

    <!-- Polar Area Chart -->
    @livewire('backend.dashboard.polar-chart')

    <!-- /Polar Area Chart -->

    <!-- Radar Chart -->
    @livewire('backend.dashboard.radar-chart')
    <!-- /Radar Chart -->

</div>
{{-- END CHART --}}

@push('scripts')
<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/chartjs/chartjs.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/charts-chartjs.js') }}"></script>
@endpush
@endsection
