@props([
    'label' => null,
    'name',
    'type'  => 'text',
])

<div class="mb-4">
  <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label ?? '' }}</label>
  <input
    type="{{ $type ?? 'text' }}"
    name="{{ $name ?? '' }}"
    value="{{ old($name) }}"
    {{ $attributes->merge(['class' => 'w-full px-3 py-2 border rounded']) }}
  />
  @error($name)
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
  @enderror
</div>