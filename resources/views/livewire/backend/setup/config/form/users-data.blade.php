<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">
            Config - Edit Users Data
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            wire:click="closeModal"></button>
    </div>
    <form wire:submit.prevent="updateUserData" method="POST">
        <div class="modal-body">
            {{-- Form Input ID Column, Name Column and Email Column --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <label for="idColumn" class="form-label">Id Column</label>
                    <input type="text" id="idColumn" class="form-control @error('id_column') is-invalid @enderror"
                        placeholder="Id Column" wire:model="id_column" />
                    @error('id_column') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="nameColumn" class="form-label">Name Column</label>
                    <input type="text" id="nameColumn" class="form-control @error('name_column') is-invalid @enderror"
                        placeholder="Name Column" wire:model="name_column" />
                    @error('name_column') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="emailColumn" class="form-label">Email Column</label>
                    <input type="text" id="emailColumn" class="form-control @error('email_column') is-invalid @enderror"
                        placeholder="Email Column" wire:model="email_column" />
                    @error('email_column') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Form Input Phone Number Column, Room Number Column and Date Column --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <label for="phoneNumberColumn" class="form-label">Phone Number Column</label>
                    <input type="text" id="phoneNumberColumn"
                        class="form-control @error('phone_number_column') is-invalid @enderror"
                        placeholder="Phone Number Column" wire:model="phone_number_column" />
                    @error('phone_number_column') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="roomNumberColumn" class="form-label">Room Number Column</label>
                    <input type="text" id="roomNumberColumn"
                        class="form-control @error('room_number_column') is-invalid @enderror"
                        placeholder="Room Number Column" wire:model="room_number_column" />
                    @error('room_number_column') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="dateColumn" class="form-label">Date Column</label>
                    <input type="text" id="dateColumn" class="form-control @error('date_column') is-invalid @enderror"
                        placeholder="Date Column" wire:model="date_column" />
                    @error('date_column') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Form Input First Name Column, Last Name Column and Mac Column --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <label for="firstNameColumn" class="form-label">First Name Column</label>
                    <input type="text" id="firstNameColumn"
                        class="form-control @error('first_name_column') is-invalid @enderror"
                        placeholder="First Name Column" wire:model="first_name_column" />
                    @error('first_name_column') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="lastNameColumn" class="form-label">Last Name Column</label>
                    <input type="text" id="lastNameColumn"
                        class="form-control @error('last_name_column') is-invalid @enderror"
                        placeholder="Last Name Column" wire:model="last_name_column" />
                    @error('last_name_column') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="macColumn" class="form-label">Mac Column</label>
                    <input type="text" id="macColumn" class="form-control @error('mac_column') is-invalid @enderror"
                        placeholder="Mac Column" wire:model="mac_column" />
                    @error('mac_column') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Form Input Location Column, Gender Column and Birthday Column --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <label for="locationColumn" class="form-label">Location Column</label>
                    <input type="text" id="locationColumn"
                        class="form-control @error('location_column') is-invalid @enderror"
                        placeholder="Location Column" wire:model="location_column" />
                    @error('location_column') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="genderColumn" class="form-label">Gender Column</label>
                    <input type="text" id="genderColumn"
                        class="form-control @error('gender_column') is-invalid @enderror" placeholder="Gender Column"
                        wire:model="gender_column" />
                    @error('gender_column') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="birthdayColumn" class="form-label">Birthday Column</label>
                    <input type="text" id="birthdayColumn"
                        class="form-control @error('birthday_column') is-invalid @enderror"
                        placeholder="Birthday Column" wire:model="birthday_column" />
                    @error('birthday_column') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Form Input Login With Column, Display ID and Display Name --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <label for="loginWithColumn" class="form-label">Login With Column</label>
                    <input type="text" id="loginWithColumn"
                        class="form-control @error('login_with_column') is-invalid @enderror"
                        placeholder="Login With Column" wire:model="login_with_column" />
                    @error('login_with_column') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="displayId" class="form-label">Display ID</label>
                    <input type="text" id="displayId" class="form-control @error('display_id') is-invalid @enderror"
                        placeholder="Display ID" wire:model="display_id" />
                    @error('display_id') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="displayName" class="form-label">Display Name</label>
                    <input type="text" id="displayName" class="form-control @error('display_name') is-invalid @enderror"
                        placeholder="Display Name" wire:model="display_name" />
                    @error('display_name') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Form Input Display Email, Display Phone Number and Display Room Number --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <label for="displayEmail" class="form-label">Display Email</label>
                    <input type="text" id="displayEmail"
                        class="form-control @error('display_email') is-invalid @enderror" placeholder="Display Email"
                        wire:model="display_email" />
                    @error('display_email') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="displayPhoneNumber" class="form-label">Display Phone Number</label>
                    <input type="text" id="displayPhoneNumber"
                        class="form-control @error('display_phone_number') is-invalid @enderror"
                        placeholder="Display Phone Number" wire:model="display_phone_number" />
                    @error('display_phone_number') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="displayRoomNumber" class="form-label">Display Room Number</label>
                    <input type="text" id="displayRoomNumber"
                        class="form-control @error('display_room_number') is-invalid @enderror"
                        placeholder="Display Room Number" wire:model="display_room_number" />
                    @error('display_room_number') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Form Input Display Date, Display First Name and Display Last Name --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <label for="displayDate" class="form-label">Display Date</label>
                    <input type="text" id="displayDate" class="form-control @error('display_date') is-invalid @enderror"
                        placeholder="Display Date" wire:model="display_date" />
                    @error('display_date') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="displayFirstName" class="form-label">Display First Name</label>
                    <input type="text" id="displayFirstName"
                        class="form-control @error('display_first_name') is-invalid @enderror"
                        placeholder="Display First Name" wire:model="display_first_name" />
                    @error('display_first_name') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="displayLastName" class="form-label">Display Last Name</label>
                    <input type="text" id="displayLastName"
                        class="form-control @error('display_last_name') is-invalid @enderror"
                        placeholder="Display Last Name" wire:model="display_last_name" />
                    @error('display_last_name') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Form Input Display Mac, Display Location and Display Gender --}}
            <div class="row g-2 mb-3">
                <div class="col mb-0">
                    <label for="displayMac" class="form-label">Display Mac</label>
                    <input type="text" id="displayMac" class="form-control @error('display_mac') is-invalid @enderror"
                        placeholder="Display Mac" wire:model="display_mac" />
                    @error('display_mac') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="displayLocation" class="form-label">Display Location</label>
                    <input type="text" id="displayLocation"
                        class="form-control @error('display_location') is-invalid @enderror"
                        placeholder="Display Location" wire:model="display_location" />
                    @error('display_location') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="displayGender" class="form-label">Display Gender</label>
                    <input type="text" id="displayGender"
                        class="form-control @error('display_gender') is-invalid @enderror" placeholder="Display Gender"
                        wire:model="display_gender" />
                    @error('display_gender') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Form Input Display Birthday and Display Login With --}}
            <div class="row g-2">
                <div class="col mb-0">
                    <label for="displayBirthday" class="form-label">Display Birthday</label>
                    <input type="text" id="displayBirthday"
                        class="form-control @error('display_birthday') is-invalid @enderror"
                        placeholder="Display Birthday" wire:model="display_birthday" />
                    @error('display_birthday') <small class="error text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col mb-0">
                    <label for="displayLoginWith" class="form-label">Display Login With</label>
                    <input type="text" id="displayLoginWith"
                        class="form-control @error('display_login_with') is-invalid @enderror"
                        placeholder="Display Login With" wire:model="display_login_with" />
                    @error('display_login_with') <small class="error text-danger">{{ $message }}</small> @enderror
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
