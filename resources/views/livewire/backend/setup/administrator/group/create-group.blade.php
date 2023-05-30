<div class="card-body">
    <form wire:submit.prevent="store" method="POST">
        <div class="row">
            <div class="col-12 mb-3">
                <x-input-field id="groupName" label="Group Name" model="groupName" placeholder="Enter a Group Name.."
                    required />
            </div>
        </div>
        <h4>Permissions</h4>

        <div class="row" wire:ignore>
            @php
            $groupedPermissions = $dataPermissions->groupBy('mod_title');
            @endphp

            @foreach($groupedPermissions as $mod_title => $permissions)
            <div class="col-12 mt-2">
                <h5 class="mb-1">{{ $mod_title }}</h5>
            </div>
            @foreach($permissions as $permission)
            <div class="col-2">
                <label class="mt-1">{{ $permission->title }}</label>
                <div class="form-check mt-1">
                    <x-radio-input id="p{{ $permission->id }}a" label="Yes" name="p{{ $permission->id }}"
                        model="permission.{{ $permission->id }}" />
                </div>
                <div class="form-check mt-1">
                    <x-radio-input id="p{{ $permission->id }}b" label="No" name="p{{ $permission->id }}" value="0"
                        model="permission.{{ $permission->id }}" checked />
                </div>
            </div>
            @endforeach
            <div class="mt-1">
                <hr>
            </div>
            @endforeach
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>

</div>
