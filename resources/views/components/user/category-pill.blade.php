@props(['active' => false, 'label' => ''])

<button {{ $attributes->merge([
  'class' => 'btn btn-sm rounded-full px-6 normal-case font-medium transition-all duration-300 relative overflow-hidden ' .
    ($active
      ? 'text-white border-none shadow-lg'
      : 'bg-white border-teal-600 text-teal-700 hover:bg-gradient-to-r hover:from-teal-600 hover:to-cyan-600 hover:text-white hover:border-teal-700 border-2')
]) }} 
@if($active)
style="background: linear-gradient(to right, #0d9488, #0891b2);"
@endif>
  <span class="relative">{{ $label }}</span>
</button>

