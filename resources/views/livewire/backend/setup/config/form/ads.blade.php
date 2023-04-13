<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">
            Config - Edit Ads
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        {{-- Form Input Ads Max Width and Ads Max Height --}}
        <div class="row g-2 mb-3">
            <div class="col mb-0">
                <label for="adsMaxWidth" class="form-label">Ads Max Width</label>
                <input type="text" id="adsMaxWidth" class="form-control" placeholder="Ads Max Width" />
            </div>
            <div class="col mb-0">
                <label for="adsMaxHeight" class="form-label">Ads Max Height</label>
                <input type="text" id="adsMaxHeight" class="form-control" placeholder="Ads Max Height" />
            </div>
        </div>

        {{-- Form Input Ads Max Size and Ads Max Size --}}
        <div class="row g-2 mb-3">
            <div class="col mb-0">
                <label for="adsMaxSize" class="form-label">Ads Max Size</label>
                <input type="text" id="adsMaxSize" class="form-control" placeholder="Ads Max Size" />
            </div>
            <div class="col mb-0">
                <label for="adsUploadFolder" class="form-label">Ads Upload Folder</label>
                <input type="text" id="adsUploadFolder" class="form-control" placeholder="Ads Upload Folder" />
            </div>
        </div>

        {{-- Form Input Ads Thumb Width and Ads Thumb Width --}}
        <div class="row g-2 mb-3">
            <div class="col mb-0">
                <label for="adsThumbWidth" class="form-label">Ads Thumb Width</label>
                <input type="text" id="adsThumbWidth" class="form-control" placeholder="Ads Thumb Width" />
            </div>
            <div class="col mb-0">
                <label for="adsThumbHeight" class="form-label">Ads Thumb Height</label>
                <input type="text" id="adsThumbHeight" class="form-control" placeholder="Ads Thumb Height" />
            </div>
        </div>

        {{-- Form Input Mobile Ads Max Width, Mobile Ads Max Height and Mobile Ads Max Size --}}
        <div class="row g-2">
            <div class="col mb-0">
                <label for="mobileAdsMaxWidth" class="form-label">Mobile Ads Max Width</label>
                <input type="text" id="mobileAdsMaxWidth" class="form-control" placeholder="Mobile Ads Max Width" />
            </div>
            <div class="col mb-0">
                <label for="mobileAdsMaxHeight" class="form-label">Mobile Ads Max Height</label>
                <input type="text" id="mobileAdsMaxHeight" class="form-control" placeholder="Mobile Ads Max Height" />
            </div>
            <div class="col mb-0">
                <label for="mobileAdsMaxSize" class="form-label">Mobile Ads Max Size</label>
                <input type="text" id="mobileAdsMaxSize" class="form-control" placeholder="Mobile Ads Max Size" />
            </div>
        </div>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Close
        </button>
        <button type="button" class="btn btn-primary">Save Changes</button>
    </div>
</div>
