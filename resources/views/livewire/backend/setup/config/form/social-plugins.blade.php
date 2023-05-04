<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">
            Config - Edit Social Plugins
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
    </div>
    <div class="modal-body">

        {{-- Form Input FB App ID and FB App Secret --}}
        <div class="row g-2 mb-3">
            <div class="col mb-0">
                <label for="fbAppId" class="form-label">FB App ID</label>
                <input type="text" id="fbAppId" class="form-control" placeholder="FB App ID" />
            </div>
            <div class="col mb-0">
                <label for="fbAppSecret" class="form-label">FB App Secret</label>
                <input type="text" id="fbAppSecret" class="form-control" placeholder="FB App Secret" />
            </div>
        </div>

        {{-- Form Input TW API Key, TW API Secret and Google API Client ID  --}}
        <div class="row g-2 mb-3">
            <div class="col mb-0">
                <label for="twApiKey" class="form-label">TW API Key</label>
                <input type="text" id="twApiKey" class="form-control" placeholder="TW API Key" />
            </div>
            <div class="col mb-0">
                <label for="twApiSecret" class="form-label">TW API Secret</label>
                <input type="text" id="twApiSecret" class="form-control" placeholder="TW API Secret" />
            </div>
            <div class="col mb-0">
                <label for="googleApiClientId" class="form-label">Google API Client ID</label>
                <input type="text" id="googleApiClientId" class="form-control" placeholder="Google API Client ID" />
            </div>
        </div>

        {{-- Form Input Login With Facebook On, Login With Twitter On and Login With Google On  --}}
        <div class="row g-2 mb-3">
            <div class="col mb-0">
                <label for="loginWithFacebookOn" class="form-label">Login With Facebook On</label>
                <input type="text" id="loginWithFacebookOn" class="form-control" placeholder="Login With Facebook On" />
            </div>
            <div class="col mb-0">
                <label for="loginWithTwitterOn" class="form-label">Login With Twitter On</label>
                <input type="text" id="loginWithTwitterOn" class="form-control" placeholder="Login With Twitter On" />
            </div>
            <div class="col mb-0">
                <label for="loginWithGooleOn" class="form-label">Login With Google On</label>
                <input type="text" id="loginWithGooleOn" class="form-control" placeholder="Login With Google On" />
            </div>
        </div>

        {{-- Form Input Login With Linkedin On and Google Api Secret  --}}
        <div class="row g-2 mb-3">
            <div class="col mb-0">
                <label for="loginWithLinkedinOn" class="form-label">Login With Linkedin On</label>
                <input type="text" id="loginWithLinkedinOn" class="form-control" placeholder="Login With Linkedin On" />
            </div>
            <div class="col mb-0">
                <label for="googleApiSecret" class="form-label">Google Api Secret</label>
                <input type="text" id="googleApiSecret" class="form-control" placeholder="Google Api Secret" />
            </div>
        </div>

        {{-- Form Input Linkedin Api Client ID and Linkedin Api Client Secret  --}}
        <div class="row g-2">
            <div class="col mb-0">
                <label for="linkedinApiClientId" class="form-label">Linkedin Api Client ID</label>
                <input type="text" id="linkedinApiClientId" class="form-control" placeholder="Linkedin Api Client ID" />
            </div>
            <div class="col mb-0">
                <label for="linkedinApiClientSecret" class="form-label">Linkedin Api Client Secret</label>
                <input type="text" id="linkedinApiClientSecret" class="form-control" placeholder="Linkedin Api Client Secret" />
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">
            Close
        </button>
        <button type="button" class="btn btn-primary">Save Changes</button>
    </div>
</div>
