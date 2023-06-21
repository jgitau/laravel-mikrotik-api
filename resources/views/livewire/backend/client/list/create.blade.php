<div>
    <div wire:ignore.self class="modal fade" id="createNewClient" tabindex="-1" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Add New Client</h5>
                        <x-button color="close" dismiss="true" click="closeModal"/>
                </div>
                <form wire:submit.prevent="storeNewClient" method="POST">
                    <div class="modal-body">
                        {{-- FORM INPUT CHOOSE SERVICE AND USERNAME --}}
                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <x-select-field id="idService" label="Service" model="idService" required
                                    :options="$services->pluck('service_name', 'id')->toArray()" />
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <x-input-field id="username" label="Username" model="username"
                                    placeholder="Enter a Username.." required />
                            </div>
                        </div>

                        {{-- FORM INPUT PASSWORD AND SIMULTANEOUS USE --}}
                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <x-input-field type="text" id="password" label="Password" model="password"
                                    placeholder="Enter a Password.." required />
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <x-input-field type="number" id="simultaneousUse" label="Simultaneous Use"
                                    model="simultaneousUse" placeholder="Enter a Simultaneous Use.." />
                            </div>
                        </div>

                        {{-- FORM INPUT PASSWORD, CONFIRM PASSWORD AND STATUS --}}
                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <x-input-field type="text" id="validFrom" label="Valid From" model="validFrom"
                                    placeholder="(YYYY-MM-DD HH:MM:SS)" />
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <x-input-field type="text" id="validTo" label="Valid To" model="validTo"
                                    placeholder="(YYYY-MM-DD HH:MM:SS)" />
                            </div>
                        </div>

                        {{-- TITLE ADMINISTRATOR DETAIL --}}
                        <div class="row">
                            <hr>
                            <h5>Client Details (Optional)</h5>
                        </div>

                        {{-- FORM INPUT IDENTIFICATION NO. AND EMAIL ADDRESS --}}
                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <x-input-field type="text" id="identificationNo" label="Identification No." model="identificationNo"
                                    placeholder="Enter a Identification Number.." />
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <x-input-field type="email" id="emailAddress" label="Email Address" model="emailAddress"
                                    placeholder="Enter a Email Address.." />
                            </div>
                        </div>

                        {{-- FORM INPUT FIRST NAME AND LAST NAME --}}
                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <x-input-field type="text" id="firstName" label="First Name" model="firstName"
                                    placeholder="Enter a First Name.." />
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <x-input-field type="text" id="lastName" label="Last Name" model="lastName"
                                    placeholder="Enter a Last Name.." />
                            </div>
                        </div>

                        {{-- FORM INPUT PLACE OF BIRTH AND DATE OF BIRTH --}}
                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <x-input-field type="text" id="placeOfBirth" label="Place of birth" model="placeOfBirth"
                                    placeholder="Enter a Place of birth.." />
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <x-input-field type="text" id="dateOfBirth" label="Date of birth" model="dateOfBirth"
                                    placeholder="Date of birth - (YYYY-MM-DD)" />
                            </div>
                        </div>

                        {{-- FORM INPUT PLACE OF BIRTH AND DATE OF BIRTH --}}
                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <x-input-field type="text" id="phone" label="Phone" model="phone"
                                    placeholder="Phone" />
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <x-input-field type="text" id="address" label="Address" model="address"
                                    placeholder="Enter a Address.." />
                            </div>
                        </div>

                        {{-- FORM NOTES --}}
                        <div class="row">
                            <div class="col">
                                <x-textarea type="text" id="notes" label="Notes" model="notes"
                                    placeholder="Enter a Notes.." />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <x-button color="secondary" dismiss="true" click="closeModal">
                            Close
                        </x-button>

                        <x-button type="submit" color="primary">
                            Save
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')

@endpush
