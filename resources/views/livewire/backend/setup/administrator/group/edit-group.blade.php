{{-- This is the card body section --}}
<div class="card-body">
    {{-- This is a form which uses a livewire event to prevent the default form submission --}}
    <form wire:submit.prevent="updateGroup" method="POST">
        {{-- A row for the Group Name input field --}}
        <div class="row">
            {{-- Column for the Group Name input field --}}
            <div class="col-12 mb-3">
                {{-- Group Name input field component --}}
                <x-input-field id="groupName" label="Group Name" model="groupName" placeholder="Enter a Group Name.."
                    required />
            </div>
        </div>

        {{-- Permissions header --}}
        <h4>Permissions</h4>
        {{-- GroupBy with Module Title --}}

        @php
        $groupedPermissions = $dataPermissions->groupBy('mod_title');
        @endphp

        {{-- A row for the permissions, which is ignored by livewire for re-rendering --}}
        <div class="row" wire:ignore>
            {{-- Loop over the grouped permissions --}}
            @foreach($groupedPermissions as $mod_title => $permissions)
            {{-- Column for the module title --}}
            <div class="col-12 mt-2">
                {{-- Display the module title --}}
                <h5 class="mb-1">{{ $mod_title }}</h5>
            </div>
            {{-- Loop over the permissions for the current module --}}
            @foreach($permissions as $permission)
            {{-- @php
                $contoh = in_array($groupData->id, explode(',', $permission->allowed_groups)) ? 'checked' : '';
                dd($contoh);
            @endphp --}}
            {{-- Column for each permission --}}
            <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-6">
                {{-- Display the permission title --}}
                <label class="mt-2">{{ $permission->title }}</label>
                {{-- Yes radio button for the current permission --}}
                <div class="form-check mt-1">
                    <x-radio-input id="p{{ $permission->id }}a" label="Yes" name="p{{ $permission->id }}"
                        model="permission.{{ $permission->id }}" />
                </div>
                {{-- No radio button for the current permission --}}
                <div class="form-check mt-1">
                    <x-radio-input id="p{{ $permission->id }}b" label="No" name="p{{ $permission->id }}" value="0"
                        model="permission.{{ $permission->id }}" />
                </div>
            </div>
            @endforeach
            {{-- Horizontal rule to separate the permissions of different modules --}}
            <div class="mt-1">
                <hr>
            </div>
            @endforeach
        </div>

        {{-- A row for the submit button --}}
        <div class="row mt-3">
            {{-- Column for the submit button --}}
            <div class="col-12">
                {{-- The submit button --}}
                <x-button type="submit" color="primary">
                    Save Changes
                </x-button>
            </div>
        </div>
    </form>
    @push('scripts')
    <script>
        window.addEventListener('redirect', event => {
            window.location.href = event.detail.url;
        });
    </script>

    @endpush
</div>
