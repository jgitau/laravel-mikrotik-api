@props(['id', 'label' => false, 'model' => false, 'type' => 'text', 'placeholder' => '', 'required' => false])

@if($label)
<label for="{{ $id }}" class="form-label">{{ $label }} @if($required)<span
        class="text-danger"><b>*</b></span>@endif</label>
@endif

<input {{ $attributes->merge(['class' => 'form-control ' . ($errors->has($model) ? 'is-invalid' : ''), 'id' => $id,
'type' => $type, 'placeholder' => $placeholder]) }}
wire:model="{{ $model ? $model : '' }}"
/>

@error($model) <small class="error text-danger">{{ $message }}</small> @enderror
