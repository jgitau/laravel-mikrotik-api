<div>
    <div wire:ignore.self class="modal fade" id="createNewAdmin" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Add New Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="storeNewAdmin" method="POST">
                    <div class="modal-body">

                        {{-- FORM INPUT CHOOSE GROUP AND USERNAME --}}
                        <div class="row">
                            <div class="col">
                                <label for="groupId" class="form-label">Choose Group <span class="text-danger"><b>*</b></span></label>
                                <select name="groupId" id="groupId" class="form-select @error('groupId') is-invalid @enderror" wire:model="groupId">
                                    <option value="" selected>-- Choice Group -- </option>
                                    @foreach($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                                @error('groupId') <small class="error text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col">
                                <label for="username" class="form-label">Username <span class="text-danger"><b>*</b></span></label>
                                <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Enter a Username.." wire:model="username">
                                @error('username') <small class="error text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- FORM INPUT PASSWORD, CONFIRM PASSWORD AND STATUS --}}
                        <div class="row mt-3">
                            <div class="col">
                                <label for="password" class="form-label">Password <span class="text-danger"><b>*</b></span></label>
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter a Password.." wire:model="password">
                                    @error('password') <small class="error text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" id="confirmPassword"
                                    class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter a Confirm Password"
                                    wire:model="password_confirmation">
                                @error('password_confirmation') <small class="error text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col">
                                <label for="status" class="form-label">Status <span class="text-danger"><b>*</b></span></label>
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" wire:model="status">
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
                                <label for="fullName" class="form-label">Full Name <span class="text-danger"><b>*</b></span></label>
                                <input type="text" id="fullName" class="form-control @error('fullName') is-invalid @enderror" placeholder="Enter a Full Name.." wire:model="fullName">
                                @error('fullName') <small class="error text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col">
                                <label for="emailAddress" class="form-label">Email Address <span class="text-danger"><b>*</b></span></label>
                                <input type="email" id="emailAddress" class="form-control @error('emailAddress') is-invalid @enderror"
                                    placeholder="Enter a Email Address.." wire:model="emailAddress">
                                    @error('emailAddress') <small class="error text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
