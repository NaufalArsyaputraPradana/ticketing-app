@props(['active' => false, 'label' => ''])

<button {{ $attributes->merge([
  'class' => 'btn btn-sm rounded-full px-6 normal-case font-medium transition-all ' .
    ($active
      ? 'text-white border-none shadow-md'
      : 'bg-white border-teal-600 text-teal-700 hover:text-white border-2')
]) }} 
@if($active)
style="background: linear-gradient(to right, #0d9488, #0891b2);"
@else
style="hover:background: linear-gradient(to right, #0d9488, #0891b2);"
@endif>
  {{ $label }}
</button>
