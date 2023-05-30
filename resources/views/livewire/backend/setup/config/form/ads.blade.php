<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">
            Config - Edit Ads
        </h5>
        <x-button color="close" dismiss="true" click="closeModal" />
    </div>
    <form wire:submit.prevent="updateAds" method="POST">
        <div class="modal-body">

            {{-- Form Input Ads Max Width and Ads Max Height --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <x-input-field id="adsMaxWidth" label="Ads Max Width" model="ads_max_width"
                        placeholder="Enter a Ads Max Width.." required />
                </div>
                <div class="col mb-0">
                    <x-input-field id="adsMaxHeight" label="Ads Max Height" model="ads_max_height"
                        placeholder="Enter a Ads Max Height.." required />
                </div>
            </div>

            {{-- Form Input Ads Max Size and Ads Max Size --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <x-input-field id="adsMaxSize" label="Ads Max Size" model="ads_max_size"
                        placeholder="Enter a Ads Max Size.." required />
                </div>
                <div class="col mb-0">
                    <x-input-field id="adsUploadFolder" label="Ads Upload Folder" model="ads_upload_folder"
                        placeholder="Enter a Ads Upload Folder.." required />
                </div>
            </div>

            {{-- Form Input Ads Thumb Width and Ads Thumb Width --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <x-input-field id="adsThumbWidth" label="Ads Thumb Width" model="ads_thumb_width"
                        placeholder="Enter a Ads Thumb Width.." required />
                </div>
                <div class="col mb-0">
                    <x-input-field id="adsThumbHeight" label="Ads Thumb Height" model="ads_thumb_height"
                        placeholder="Enter a Ads Thumb Height.." required />
                </div>
            </div>

            {{-- Form Input Mobile Ads Max Width, Mobile Ads Max Height and Mobile Ads Max Size --}}
            <div class="row g-2">
                <div class="col mb-0">
                    <x-input-field id="mobileAdsMaxWidth" label="Mobile Ads Max Width" model="mobile_ads_max_width"
                        placeholder="Enter a Mobile Ads Max Width.." required />
                </div>
                <div class="col mb-0">
                    <x-input-field id="mobileAdsMaxHeight" label="Mobile Ads Max Height" model="mobile_ads_max_height"
                        placeholder="Enter a Mobile Ads Max Height.." required />
                </div>
                <div class="col mb-0">
                    <x-input-field id="mobileAdsMaxSize" label="Mobile Ads Max Size" model="mobile_ads_max_size"
                        placeholder="Enter a Mobile Ads Max Size.." required />
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
