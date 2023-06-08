@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Dashboard')

@section('content')
<div class="row">

    {{-- *** TODO: *** --}}
    {{-- Start Lise Statictics --}}
    @livewire('backend.dashboard.list-statistic')
    {{-- End Lise Statictics --}}

</div>

{{-- START CHART --}}
<div class="row">

    {{-- *** TODO: *** --}}
    <!-- Line Charts -->
    @livewire('backend.dashboard.line-chart')
    <!-- /Line Charts -->

    <!-- Polar Area Chart -->
    @livewire('backend.dashboard.polar-chart')
    <!-- /Polar Area Chart -->

    {{-- *** TODO: *** --}}
    <!-- Radar Chart -->
    @livewire('backend.dashboard.radar-chart')
    <!-- /Radar Chart -->

</div>
{{-- END CHART --}}

@push('scripts')
<!-- Vendors JS -->
{{-- <script src="{{ asset('assets/vendor/libs/chartjs/chartjs.js') }}"></script> --}}

{{-- <script src="{{ asset('assets/js/backend/dashboard/chart.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/backend/dashboard/chart.js') }}"></script> --}}

{{--
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.2"></script>
<script src="https://cdn.jsdelivr.net/npm/luxon@1.27.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.0.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-streaming@2.0.0"></script> --}}

<!-- Page JS -->
<script src="{{ asset('assets/js/charts-chartjs.js') }}"></script>
@endpush
@endsection
