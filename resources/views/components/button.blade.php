@props(['type' => 'button', 'color' => 'primary', 'dismiss' => false, 'click' => false])

<button type="{{ $type }}" class="btn btn-{{ $color }}" {{ $dismiss ? 'data-bs-dismiss="modal"' : '' }} {{ $click
    ? 'wire:click=' . $click : '' }}>
    {{ $slot }}
</button>
