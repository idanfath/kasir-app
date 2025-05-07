@props(['orientation' => 'horizontal'])

@if ($orientation == 'horizontal')
    <hr {{ $attributes->merge(['class' => 'border-neutral-500 ']) }}>
@else
    <div {{ $attributes->merge(['class' => 'border-l border-neutral-500  h-full']) }}></div>
@endif
