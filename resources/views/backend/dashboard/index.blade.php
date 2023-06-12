@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Dashboard')

@section('content')
<div class="row">

    {{-- *** TODO: *** --}}
    {{-- Start Lise Statictics --}}
    @if($isAllowedToAdministrator)
    @livewire('backend.dashboard.list-statistic')
    @endif
    {{-- End Lise Statictics --}}

</div>

{{-- START CHART --}}
<div class="row">
    <!-- Line Charts -->
    {{-- @livewire('backend.dashboard.line-chart') --}}
    <!-- /Line Charts -->

    <!-- Polar Area Chart -->
    {{-- @livewire('backend.dashboard.polar-chart') --}}
    <!-- /Polar Area Chart -->

    <!-- Radar Chart -->
    {{-- @livewire('backend.dashboard.radar-chart') --}}
    <!-- /Radar Chart -->

</div>
{{-- END CHART --}}

@push('scripts')
<!-- Apex Chart -->
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endpush
@endsection
