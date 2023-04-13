<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">
            Config - Edit Clients
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        {{-- *** TODO: ***  --}}
        {{-- Form Select Clients Vouchers Printer--}}
        <div class="row">
            <div class="col mb-3">
                <label for="clientsVouchersPrinter" class="form-label">Clients Vouchers Printer</label>
                <select name="clientsVouchersPrinter" id="clientsVouchersPrinter" class="form-select">
                    <option value="">-- Choice Vouchers Printer -- </option>
                </select>
            </div>
        </div>

        {{-- Form Select Create Vouchers Type--}}
        <div class="row g-2">
            <div class="col mb-0">
                <label for="createVouchersType" class="form-label">Create Vouchers Type</label>
                <select name="clientsVouchersPrinter" id="clientsVouchersPrinter" class="form-select">
                    <option value="">-- Choice Vouchers Type -- </option>
                </select>
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
