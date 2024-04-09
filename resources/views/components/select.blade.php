@props(['name', 'options', 'selected' => null])

<select {{ $attributes->merge(['class' => 'block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }} name="{{ $name }}">
    @foreach($options as $key => $value)
    <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>

@error($name)
<p class="text-sm text-red-600 mt-1" role="alert">{{ $message }}</p>
@enderror
