@props(['id', 'label' => false, 'model' => false, 'value' => '1', 'name' => '', 'type' => 'radio'])

@if($label)
<label for="{{ $id }}" class="form-check-label">{{ $label }}</label>
@endif

<input {{ $attributes->merge(['class' => 'form-check-input', 'id' => $id, 'type' => $type, 'value' => $value, 'name' =>
$name]) }}
wire:model="{{ $model ? $model : '' }}"
/>

@error($model) <small class="error text-danger">{{ $message }}</small> @enderror
