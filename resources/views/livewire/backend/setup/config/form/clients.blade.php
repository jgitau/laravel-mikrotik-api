<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">
            Config - Edit Clients
        </h5>
        <x-button color="close" dismiss="true" click="closeModal" />
    </div>
    <form wire:submit.prevent="updateClient" method="POST">
        <div class="modal-body">

            {{-- Form Select Clients Vouchers Printer--}}
            <div class="row">
                <div class="col mb-3">
                    <x-select-field id="clientsVouchersPrinter" label="Clients Vouchers Printer"
                        model="clientsVouchersPrinter" required
                        :options="['single_column_voucher_printer' => 'Single Column Voucher Printer', 'double_column_voucher_printer' => 'Double Column Voucher Printer']" />
                </div>
            </div>

            {{-- Form Select Create Vouchers Type--}}
            <div class="row g-2">
                <div class="col mb-0">
                    <x-select-field id="createVouchersType" label="Create Vouchers Type" model="createVouchersType"
                        required :options="['no_password' => 'No Password', 'with_password' => 'With Password']" />
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
