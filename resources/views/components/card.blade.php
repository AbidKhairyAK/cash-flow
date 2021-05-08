@props(['noPadding' => false])

<div {{ $attributes->merge(['class' => 'bg-white overflow-hidden shadow-sm rounded-lg', 'style']) }}>
	<div class="bg-white border-b border-gray-200 {{ $noPadding ?: 'lg:p-6 p-4' }}">
		{{ $slot }}
	</div>
</div>
