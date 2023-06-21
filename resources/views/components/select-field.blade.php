@props(['id', 'label', 'model' => false, 'required' => false, 'options' => []])

<label for="{{ $id }}" class="form-label">{{ $label }} @if($required)<span
        class="text-danger"><b>*</b></span>@endif</label>

<select {{ $attributes->merge(['class' => 'form-select ' . ($model && $errors->has($model) ? 'is-invalid' : ''), 'id' =>
    $id, 'name' => $id]) }} {{ $model ? 'wire:model=' . $model : '' }}>
    <option value="" style="color: #a5a5a5">-- Choice {{ $label }} -- </option>
    @foreach ($options as $value => $display)
    <option value="{{ $value }}">{{ $display }}</option>
    @endforeach
</select>

@error($model) <small class="error text-danger">{{ $message }}</small> @enderror
