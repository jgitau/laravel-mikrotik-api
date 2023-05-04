<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">
            Config - Edit Ads
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            wire:click="closeModal"></button>
    </div>
    <form wire:submit.prevent="updateAds" method="POST">
        <div class="modal-body">
            {{-- Form Input Ads Max Width and Ads Max Height --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <label for="adsMaxWidth" class="form-label">Ads Max Width</label>
                    <input type="text" id="adsMaxWidth"
                        class="form-control @error('ads_max_width') is-invalid @enderror" placeholder="Ads Max Width"
                        wire:model='ads_max_width' />
                    @error('ads_max_width') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="adsMaxHeight" class="form-label">Ads Max Height</label>
                    <input type="text" id="adsMaxHeight"
                        class="form-control @error('ads_max_height') is-invalid @enderror" placeholder="Ads Max Height"
                        wire:model='ads_max_height' />
                    @error('ads_max_height') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Form Input Ads Max Size and Ads Max Size --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <label for="adsMaxSize" class="form-label">Ads Max Size</label>
                    <input type="text" id="adsMaxSize" class="form-control @error('ads_max_size') is-invalid @enderror"
                        placeholder="Ads Max Size" wire:model='ads_max_size' />
                    @error('ads_max_size') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="adsUploadFolder" class="form-label">Ads Upload Folder</label>
                    <input type="text" id="adsUploadFolder"
                        class="form-control @error('ads_upload_folder') is-invalid @enderror"
                        placeholder="Ads Upload Folder" wire:model='ads_upload_folder' />
                    @error('ads_upload_folder') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Form Input Ads Thumb Width and Ads Thumb Width --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <label for="adsThumbWidth" class="form-label">Ads Thumb Width</label>
                    <input type="text" id="adsThumbWidth"
                        class="form-control @error('ads_thumb_width') is-invalid @enderror"
                        placeholder="Ads Thumb Width" wire:model='ads_thumb_width' />
                    @error('ads_thumb_width') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="adsThumbHeight" class="form-label">Ads Thumb Height</label>
                    <input type="text" id="adsThumbHeight"
                        class="form-control @error('ads_thumb_height') is-invalid @enderror"
                        placeholder="Ads Thumb Height" wire:model='ads_thumb_height' />
                    @error('ads_thumb_height') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Form Input Mobile Ads Max Width, Mobile Ads Max Height and Mobile Ads Max Size --}}
            <div class="row g-2">
                <div class="col mb-0">
                    <label for="mobileAdsMaxWidth" class="form-label">Mobile Ads Max Width</label>
                    <input type="text" id="mobileAdsMaxWidth"
                        class="form-control @error('mobile_ads_max_width') is-invalid @enderror"
                        placeholder="Mobile Ads Max Width" wire:model='mobile_ads_max_width' />
                    @error('mobile_ads_max_width') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="mobileAdsMaxHeight" class="form-label">Mobile Ads Max Height</label>
                    <input type="text" id="mobileAdsMaxHeight"
                        class="form-control @error('mobile_ads_max_height') is-invalid @enderror"
                        placeholder="Mobile Ads Max Height" wire:model='mobile_ads_max_height' />
                    @error('mobile_ads_max_height') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="mobileAdsMaxSize" class="form-label">Mobile Ads Max Size</label>
                    <input type="text" id="mobileAdsMaxSize"
                        class="form-control @error('mobile_ads_max_size') is-invalid @enderror"
                        placeholder="Mobile Ads Max Size" wire:model='mobile_ads_max_size' />
                    @error('mobile_ads_max_size') <small class="error text-danger">{{ $message }}</small> @enderror
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
