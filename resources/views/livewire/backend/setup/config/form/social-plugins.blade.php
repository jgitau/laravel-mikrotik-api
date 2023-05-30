<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">
            Config - Edit Social Plugins
        </h5>
        <x-button color="close" dismiss="true" click="closeModal" />
    </div>
    <form wire:submit.prevent="updateSocialPlugin" method="POST">
        <div class="modal-body">

            {{-- Form Input FB App ID and FB App Secret --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <x-input-field id="fbAppId" label="FB App ID" model="fb_app_id" placeholder="Enter a FB App ID.."
                        required />
                </div>
                <div class="col mb-0">
                    <x-input-field id="fbAppSecret" label="FB App Secret" model="fb_app_secret"
                        placeholder="Enter a FB App Secret.." required />
                </div>
            </div>

            {{-- Form Input TW API Key, TW API Secret and Google API Client ID --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <x-input-field id="twApiKey" label="TW API Key" model="tw_api_key"
                        placeholder="Enter a TW API Key.." required />
                </div>
                <div class="col mb-0">
                    <x-input-field id="twApiSecret" label="TW API Secret" model="tw_api_secret"
                        placeholder="Enter a TW API Secret.." required />
                </div>
                <div class="col mb-0">
                    <x-input-field id="googleApiClientId" label="Google API Client ID" model="google_api_client_id"
                        placeholder="Enter a Google API Client ID.." required />
                </div>
            </div>

            {{-- Form Input Login With Facebook On, Login With Twitter On and Login With Google On --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <x-input-field id="loginWithFacebookOn" label="Login With Facebook On"
                        model="login_with_facebook_on" placeholder="Enter a Login With Facebook On.." required />
                </div>
                <div class="col mb-0">
                    <x-input-field id="loginWithTwitterOn" label="Login With Twitter On" model="login_with_twitter_on"
                        placeholder="Enter a Login With Twitter On.." required />
                </div>
                <div class="col mb-0">
                    <x-input-field id="loginWithGooleOn" label="Login With Google On" model="login_with_google_on"
                        placeholder="Enter a Login With Google On.." required />
                </div>
            </div>

            {{-- Form Input Login With Linkedin On and Google Api Secret --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <x-input-field id="loginWithLinkedinOn" label="Login With Linkedin On"
                        model="login_with_linkedin_on" placeholder="Enter a Login With Linkedin On.." required />
                </div>
                <div class="col mb-0">
                    <x-input-field id="googleApiSecret" label="Google Api Secret" model="google_api_client_secret"
                        placeholder="Enter a Google Api Secret.." required />
                </div>
            </div>

            {{-- Form Input Linkedin Api Client ID and Linkedin Api Client Secret --}}
            <div class="row g-2">
                <div class="col mb-0">
                    <x-input-field id="linkedinApiClientId" label="Linkedin Api Client ID"
                        model="linkedin_api_client_id" placeholder="Enter a Linkedin Api Client ID.." required />
                </div>
                <div class="col mb-0">
                    <x-input-field id="linkedinApiClientSecret" label="Linkedin Api Client Secret"
                        model="linkedin_api_client_secret" placeholder="Enter a Linkedin Api Client Secret.."
                        required />
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <x-button color="secondary" dismiss="true" click="closeModal">
                Close
            </x-button>
            <x-button type="submit" color="primary">
                Save Changes
            </x-button>
        </div>
    </form>
</div>
