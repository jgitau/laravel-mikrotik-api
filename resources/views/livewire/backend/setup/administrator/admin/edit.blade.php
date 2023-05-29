<div>
    <div wire:ignore.self class="modal fade" id="updateAdminModal" tabindex="-1" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="updateAdmin" method="POST">
                    <div class="modal-body">

                        {{-- FORM INPUT CHOOSE GROUP AND USERNAME --}}
                        <div class="row">
                            <div class="col">
                                <label for="groupIdUpdate" class="form-label">Choose Group <span class="text-danger"><b>*</b></span></label>
                                <input type="hidden" id="adminUid" class="form-control" wire:model="admin_uid">
                                <select name="group_id" id="groupIdUpdate"
                                    class="form-select @error('group_id') is-invalid @enderror" wire:model="group_id">
                                    <option value="" selected>-- Choice Group -- </option>
                                    @foreach($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                                @error('group_id') <small class="error text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col">
                                <label for="usernameUpdate" class="form-label">Username <span class="text-danger"><b>*</b></span></label>
                                <input type="text" id="usernameUpdate"
                                    class="form-control @error('username') is-invalid @enderror"
                                    placeholder="Enter a Username.." wire:model="username">
                                @error('username') <small class="error text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- FORM INPUT PASSWORD, CONFIRM PASSWORD AND STATUS --}}
                        <div class="row mt-3">
                            <div class="col">
                                <label for="passwordUpdate" class="form-label">Password </label>
                                <input type="password" id="passwordUpdate"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter a Password.." wire:model="password">
                                @if($password)
                                @error('password') <small class="error text-danger">{{ $message }}</small> @enderror
                                @else
                                <small class="text-danger">Leave it blank if you don't want it to change.</small>
                                @endif
                            </div>
                            <div class="col">
                                <label for="statusUpdate" class="form-label">Status <span class="text-danger"><b>*</b></span></label>
                                <select name="status" id="statusUpdate"
                                    class="form-select @error('status') is-invalid @enderror" wire:model="status">
                                    <option value="">-- Choice Status -- </option>
                                    <option value="1">Active</option>
                                    <option value="0">Not Active</option>
                                </select>
                                @error('status') <small class="error text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- TITLE ADMINISTRATOR DETAIL --}}
                        <div class="row mt-3">
                            <hr>
                            <h5>Administrator Details</h5>
                        </div>

                        {{-- FORM INPUT FULL NAME AND EMAIL ADDRESS --}}
                        <div class="row">
                            <div class="col">
                                <label for="fullNameUpdate" class="form-label">Full Name <span class="text-danger"><b>*</b></span></label>
                                <input type="text" id="fullNameUpdate"
                                    class="form-control @error('fullname') is-invalid @enderror"
                                    placeholder="Enter a Full Name.." wire:model="fullname">
                                @error('fullname') <small class="error text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col">
                                <label for="emailAddressUpdate" class="form-label">Email Address <span class="text-danger"><b>*</b></span></label>
                                <input type="email" id="emailAddressUpdate"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter a Email Address.." wire:model="email">
                                @error('email') <small class="error text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
