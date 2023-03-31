@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Dashboard')

@section('content')
<div class="row">

  <div class="col-xl-12 mb-4 col-lg-12 col-12">
    <div class="card h-100">
      <div class="card-header">
        <div class="d-flex justify-content-between">
          <h3 class="card-title mb-0">Statistics</h3>
          {{-- <small class="text-muted">Updated 1 month ago</small> --}}
        </div>
      </div>
      <div class="card-body">
        <div class="row gy-3">

          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-primary me-3 p-2">
                <i class="ti ti-chart-pie-2 ti-sm"></i>
              </div>
              <div class="card-info">
                <h6 class="mb-0">CPU Load</h6>
                {{-- <small>CPU Load</small> --}}
              </div>
            </div>
          </div>

          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-info me-3 p-2">
                {{-- <i class="ti ti-users ti-sm"></i> --}}
                <i class="fa-solid fa-network-wired ti-sm"></i>
              </div>
              <div class="card-info">
                <h5 class="mb-0">8.549k</h5>
                <small>Total PPPoE Secret</small>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-danger me-3 p-2">
                <i class="fa-brands fa-hive ti-sm"></i>
              </div>
              <div class="card-info">
                <h5 class="mb-0">1.423k</h5>
                <small>Hotspot Active</small>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-warning me-3 p-2">
                <i class="fa-solid fa-clock ti-sm"></i>
              </div>
              <div class="card-info">
                <h5 class="mb-0">$9745</h5>
                <small>Uptime</small>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-twitter me-3 p-2">
                <i class="fa-solid fa-circle-info ti-sm"></i>
              </div>
              <div class="card-info">
                <h5 class="mb-0">Info</h5>
                <small class="mb-0">Model :</small>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-google-plus me-3 p-2">
                <i class="fa-solid fa-memory ti-sm"></i>
              </div>
              <div class="card-info">
                <h5 class="mb-0">$9745</h5>
                <small>Free Memory / HDD</small>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-instagram me-3 p-2">
                <i class="fa-solid fa-ethernet ti-sm"></i>
              </div>
              <div class="card-info">
                <h5 class="mb-0">$9745</h5>
                <small>PPPoE Active</small>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-vimeo me-3 p-2">
                <i class="fa-solid fa-wifi ti-sm"></i>
              </div>
              <div class="card-info">
                <h5 class="mb-0">$9745</h5>
                <small>Total User Hotspot</small>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!--/ Statistics -->
</div>
@endsection
