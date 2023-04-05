{{-- Bacground Color for Dark Mode : style="background-color: rgb(40, 40, 45,0.8)" --}}
<div class="card" >
    <div class="card-body">
        <!-- Logo -->
        <div class="app-brand justify-content-center mb-3">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
                <img src="{{ asset('assets/images/logo/new-megalos-logo-blue2.png') }}" alt="" width="250">
            </a>
        </div>
        <!-- /Logo -->
        <h4 class="mb-3 text-center">Welcome to {{config('variables.templateName')}}! 👋</h4>
        @if (session()->has('error'))
        <div>
            <div class="alert alert-danger alert-dismissible" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
        <form wire:submit.prevent="submit" class="mb-3" method="POST">
            {{-- Input Username --}}
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                    name="username" placeholder="Enter your Username" wire:model.lazy="username" autofocus>
                @error('username') <small class="error text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Input Password --}}
            <div class="mb-5 form-password-toggle">
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                </div>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password" wire:model.lazy="password" />
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
                @error('password') <small class="error text-danger">{{ $message }}</small> @enderror
            </div>
            {{-- Button Sign In --}}
            <div class="mb-5">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
        </form>
    </div>
</div>
