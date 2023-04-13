<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">
            Config - Edit Users Data
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        {{-- Form Input ID Column, Name Column and Email Column --}}
        <div class="row g-2 mb-3">
            <div class="col mb-0">
                <label for="idColumn" class="form-label">Id Column</label>
                <input type="text" id="idColumn" class="form-control" placeholder="Id Column" />
            </div>
            <div class="col mb-0">
                <label for="nameColumn" class="form-label">Name Column</label>
                <input type="text" id="nameColumn" class="form-control" placeholder="Name Column" />
            </div>
            <div class="col mb-0">
                <label for="emailColumn" class="form-label">Email Column</label>
                <input type="text" id="emailColumn" class="form-control" placeholder="Email Column" />
            </div>
        </div>

        {{-- Form Input Phone Number Column, Room Number Column and Date Column --}}
        <div class="row g-2 mb-3">
            <div class="col mb-0">
                <label for="phoneNumberColumn" class="form-label">Phone Number Column</label>
                <input type="text" id="phoneNumberColumn" class="form-control" placeholder="Phone Number Column" />
            </div>
            <div class="col mb-0">
                <label for="roomNumberColumn" class="form-label">Room Number Column</label>
                <input type="text" id="roomNumberColumn" class="form-control" placeholder="Room Number Column" />
            </div>
            <div class="col mb-0">
                <label for="dateColumn" class="form-label">Date Column</label>
                <input type="text" id="dateColumn" class="form-control" placeholder="Date Column" />
            </div>
        </div>

        {{-- Form Input First Name Column, Last Name Column and Mac Column --}}
        <div class="row g-2 mb-3">
            <div class="col mb-0">
                <label for="firstNameColumn" class="form-label">First Name Column</label>
                <input type="text" id="firstNameColumn" class="form-control" placeholder="First Name Column" />
            </div>
            <div class="col mb-0">
                <label for="lastNameColumn" class="form-label">Last Name Column</label>
                <input type="text" id="lastNameColumn" class="form-control" placeholder="Last Name Column" />
            </div>
            <div class="col mb-0">
                <label for="macColumn" class="form-label">Mac Column</label>
                <input type="text" id="macColumn" class="form-control" placeholder="Mac Column" />
            </div>
        </div>

        {{-- Form Input Location Column, Gender Column and Birthday Column --}}
        <div class="row g-2 mb-3">
            <div class="col mb-0">
                <label for="locationColumn" class="form-label">Location Column</label>
                <input type="text" id="locationColumn" class="form-control" placeholder="Location Column" />
            </div>
            <div class="col mb-0">
                <label for="genderColumn" class="form-label">Gender Column</label>
                <input type="text" id="genderColumn" class="form-control" placeholder="Gender Column" />
            </div>
            <div class="col mb-0">
                <label for="birthdayColumn" class="form-label">Birthday Column</label>
                <input type="text" id="birthdayColumn" class="form-control" placeholder="Birthday Column" />
            </div>
        </div>

        {{-- Form Input Login With Column, Display ID and Display Name --}}
        <div class="row g-2 mb-3">
            <div class="col mb-0">
                <label for="loginWithColumn" class="form-label">Login With Column</label>
                <input type="text" id="loginWithColumn" class="form-control" placeholder="Login With Column" />
            </div>
            <div class="col mb-0">
                <label for="displayId" class="form-label">Display ID</label>
                <input type="text" id="displayId" class="form-control" placeholder="Display ID" />
            </div>
            <div class="col mb-0">
                <label for="displayName" class="form-label">Display Name</label>
                <input type="text" id="displayName" class="form-control" placeholder="Display Name" />
            </div>
        </div>

        {{-- Form Input Display Email, Display Phone Number and Display Room Number --}}
        <div class="row g-2 mb-3">
            <div class="col mb-0">
                <label for="displayEmail" class="form-label">Display Email</label>
                <input type="text" id="displayEmail" class="form-control" placeholder="Display Email" />
            </div>
            <div class="col mb-0">
                <label for="displayPhoneNumber" class="form-label">Display Phone Number</label>
                <input type="text" id="displayPhoneNumber" class="form-control" placeholder="Display Phone Number" />
            </div>
            <div class="col mb-0">
                <label for="displayRoomNumber" class="form-label">Display Room Number</label>
                <input type="text" id="displayRoomNumber" class="form-control" placeholder="Display Room Number" />
            </div>
        </div>

        {{-- Form Input Display Date, Display First Name and Display Last Name --}}
        <div class="row g-2 mb-3">
            <div class="col mb-0">
                <label for="displayDate" class="form-label">Display Date</label>
                <input type="text" id="displayDate" class="form-control" placeholder="Display Date" />
            </div>
            <div class="col mb-0">
                <label for="displayFirstName" class="form-label">Display First Name</label>
                <input type="text" id="displayFirstName" class="form-control" placeholder="Display First Name" />
            </div>
            <div class="col mb-0">
                <label for="displayLastName" class="form-label">Display Last Name</label>
                <input type="text" id="displayLastName" class="form-control" placeholder="Display Last Name" />
            </div>
        </div>

        {{-- Form Input Display Mac, Display Location and Display Gender --}}
        <div class="row g-2 mb-3">
            <div class="col mb-0">
                <label for="displayMac" class="form-label">Display Mac</label>
                <input type="text" id="displayMac" class="form-control" placeholder="Display Mac" />
            </div>
            <div class="col mb-0">
                <label for="displayLocation" class="form-label">Display Location</label>
                <input type="text" id="displayLocation" class="form-control" placeholder="Display Location" />
            </div>
            <div class="col mb-0">
                <label for="displayGender" class="form-label">Display Gender</label>
                <input type="text" id="displayGender" class="form-control" placeholder="Display Gender" />
            </div>
        </div>

        {{-- Form Input Display Birthday and Display Login With --}}
        <div class="row g-2">
            <div class="col mb-0">
                <label for="displayBirthday" class="form-label">Display Birthday</label>
                <input type="text" id="displayBirthday" class="form-control" placeholder="Display Birthday" />
            </div>
            <div class="col mb-0">
                <label for="displayLoginWith" class="form-label">Display Login With</label>
                <input type="text" id="displayLoginWith" class="form-control" placeholder="Display Login With" />
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
