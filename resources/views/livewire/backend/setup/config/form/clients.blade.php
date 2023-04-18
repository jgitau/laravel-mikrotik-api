<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">
            Config - Edit Clients
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            wire:click="closeModal"></button>
    </div>
    <form wire:submit.prevent="updateClient" method="POST">
        <div class="modal-body">
            {{-- *** TODO: *** --}}
            {{-- Form Select Clients Vouchers Printer--}}
            <div class="row">
                <div class="col mb-3">
                    <label for="clientsVouchersPrinter" class="form-label">Clients Vouchers Printer</label>
                    <select name="clientsVouchersPrinter" id="clientsVouchersPrinter"
                        class="form-select @error('clientsVouchersPrinter') is-invalid @enderror"
                        wire:model="clientsVouchersPrinter">
                        <option value="" selected hidden>-- Choice Vouchers Printer -- </option>
                        <option value="single_column_voucher_printer">Single Column Voucher Printer</option>
                        <option value="double_column_voucher_printer">Double Column Voucher Printer</option>
                    </select>
                    @error('clientsVouchersPrinter') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Form Select Create Vouchers Type--}}
            <div class="row g-2">
                <div class="col mb-0">
                    <label for="createVouchersType" class="form-label">Create Vouchers Type</label>
                    <select name="createVouchersType" id="createVouchersType"
                        class="form-select @error('createVouchersType') is-invalid @enderror"
                        wire:model="createVouchersType">
                        <option value="" selected hidden>-- Choice Vouchers Type -- </option>
                        <option value="no_password">No Password</option>
                        <option value="with_password">With Password</option>
                    </select>
                    @error('createVouchersType') <small class="error text-danger">{{ $message }}</small> @enderror
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
