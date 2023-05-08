<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">
            Config - Edit Social Plugins
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            wire:click="closeModal"></button>
    </div>
    <form wire:submit.prevent="updateSocialPlugin" method="POST">
        <div class="modal-body">

            {{-- Form Input FB App ID and FB App Secret --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <label for="fbAppId" class="form-label">FB App ID</label>
                    <input type="text" id="fbAppId" class="form-control @error('fb_app_id') is-invalid @enderror" placeholder="FB App ID" wire:model='fb_app_id' />
                    @error('fb_app_id') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="fbAppSecret" class="form-label">FB App Secret</label>
                    <input type="text" id="fbAppSecret" class="form-control @error('fb_app_secret') is-invalid @enderror" placeholder="FB App Secret" wire:model='fb_app_secret' />
                    @error('fb_app_secret') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Form Input TW API Key, TW API Secret and Google API Client ID --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <label for="twApiKey" class="form-label">TW API Key</label>
                    <input type="text" id="twApiKey" class="form-control @error('tw_api_key') is-invalid @enderror" placeholder="TW API Key" wire:model='tw_api_key' />
                    @error('tw_api_key') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="twApiSecret" class="form-label">TW API Secret</label>
                    <input type="text" id="twApiSecret" class="form-control @error('tw_api_secret') is-invalid @enderror" placeholder="TW API Secret" wire:model='tw_api_secret' />
                    @error('tw_api_secret') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="googleApiClientId" class="form-label">Google API Client ID</label>
                    <input type="text" id="googleApiClientId" class="form-control @error('google_api_client_id') is-invalid @enderror" placeholder="Google API Client ID" wire:model='google_api_client_id' />
                    @error('google_api_client_id') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Form Input Login With Facebook On, Login With Twitter On and Login With Google On --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <label for="loginWithFacebookOn" class="form-label">Login With Facebook On</label>
                    <input type="text" id="loginWithFacebookOn" class="form-control @error('login_with_facebook_on') is-invalid @enderror"
                        placeholder="Login With Facebook On" wire:model='login_with_facebook_on' />
                        @error('login_with_facebook_on') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="loginWithTwitterOn" class="form-label">Login With Twitter On</label>
                    <input type="text" id="loginWithTwitterOn" class="form-control @error('login_with_twitter_on') is-invalid @enderror"
                        placeholder="Login With Twitter On" wire:model='login_with_twitter_on' />
                        @error('login_with_twitter_on') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="loginWithGooleOn" class="form-label">Login With Google On</label>
                    <input type="text" id="loginWithGooleOn" class="form-control @error('login_with_google_on') is-invalid @enderror" placeholder="Login With Google On" wire:model='login_with_google_on' />
                    @error('login_with_google_on') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Form Input Login With Linkedin On and Google Api Secret --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <label for="loginWithLinkedinOn" class="form-label">Login With Linkedin On</label>
                    <input type="text" id="loginWithLinkedinOn" class="form-control @error('login_with_linkedin_on') is-invalid @enderror"
                        placeholder="Login With Linkedin On" wire:model='login_with_linkedin_on' />
                        @error('login_with_linkedin_on') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="googleApiSecret" class="form-label">Google Api Secret</label>
                    <input type="text" id="googleApiSecret" class="form-control @error('google_api_client_secret') is-invalid @enderror" placeholder="Google Api Secret" wire:model='google_api_client_secret' />
                    @error('google_api_client_secret') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Form Input Linkedin Api Client ID and Linkedin Api Client Secret --}}
            <div class="row g-2">
                <div class="col mb-0">
                    <label for="linkedinApiClientId" class="form-label">Linkedin Api Client ID</label>
                    <input type="text" id="linkedinApiClientId" class="form-control @error('linkedin_api_client_id') is-invalid @enderror"
                        placeholder="Linkedin Api Client ID" wire:model='linkedin_api_client_id' />
                        @error('linkedin_api_client_id') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="linkedinApiClientSecret" class="form-label">Linkedin Api Client Secret</label>
                    <input type="text" id="linkedinApiClientSecret" class="form-control @error('linkedin_api_client_secret') is-invalid @enderror"
                        placeholder="Linkedin Api Client Secret" wire:model='linkedin_api_client_secret' />
                        @error('linkedin_api_client_secret') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">
                Close
            </button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>
