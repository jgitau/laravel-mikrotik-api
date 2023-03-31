<div class="card" style="background-color: rgb(40, 40, 45,0.8)">
  <div class="card-body">
    <!-- Logo -->
    <div class="app-brand justify-content-center mb-3">
      <a href="{{url('/')}}" class="app-brand-link gap-2">
        {{-- <span class="app-brand-logo demo">@include('_partials.macros',["height"=>20,"withbg"=>'fill:
          #fff;'])</span> --}}
        <img src="{{ asset('assets/images/logo/new-megalos-logo-yellow-2.png') }}" alt="" width="250">
        {{-- <span class="app-brand-text demo text-body fw-bold ms-1">{{config('variables.templateName')}}</span>
        --}}
      </a>
    </div>
    <!-- /Logo -->
    <h4 class="mb-3 text-center">Welcome to {{config('variables.templateName')}}! 👋</h4>
    {{-- <p class="mb-4">Please sign-in to your account and start the adventure</p> --}}

    <form wire:submit.prevent="submit" class="mb-3" method="POST">
      {{-- Input IP Address --}}
      <div class="mb-3">
        <label for="ip" class="form-label">IP Address</label>
        <input type="text" class="form-control @error('ip') is-invalid @enderror" id="ip" name="ip"
          placeholder="Enter your IP Adress" wire:model.lazy="ip" autofocus>
        @error('ip') <small class="error text-danger">{{ $message }}</small> @enderror
      </div>

      {{-- Input Username --}}
      <div class="mb-3">
        <label for="user" class="form-label">Username</label>
        <input type="text" class="form-control @error('user') is-invalid @enderror" id="user" name="user"
          placeholder="Enter your username" wire:model.lazy="user" autofocus>
        @error('user') <small class="error text-danger">{{ $message }}</small> @enderror
      </div>

      {{-- Input Password --}}
      <div class="mb-5 form-password-toggle">
        <div class="d-flex justify-content-between">
          <label class="form-label" for="pass">Password</label>
        </div>
        <div class="input-group input-group-merge">
          <input type="password" id="pass" class="form-control @error('pass') is-invalid @enderror" name="pass"
            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
            aria-describedby="pass" wire:model.lazy="pass" />
          <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
        </div>
        @error('pass') <small class="error text-danger">{{ $message }}</small> @enderror
      </div>
      {{-- Button Sign In --}}
      <div class="mb-5">
        <button class="btn btn-warning d-grid w-100" type="submit">Sign in</button>
      </div>
    </form>

    {{-- Social Media Login --}}
    {{-- *** TODO: *** --}}
    {{-- <div class="d-flex justify-content-center">

      <a href="javascript:;" class="btn btn-icon btn-label-instagram me-3">
        <i class="tf-icons fa-brands fa-instagram fs-5"></i>
      </a>
      <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
        <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
      </a>

      <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
        <i class="tf-icons fa-brands fa-google fs-5"></i>
      </a>

      <a href="javascript:;" class="btn btn-icon btn-label-twitter">
        <i class="tf-icons fa-brands fa-twitter fs-5"></i>
      </a>

    </div> --}}

  </div>
</div>
