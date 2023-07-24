@php
     $close = asset('images/home/close.svg')
@endphp
<button wire:click='ignoreQuestion'>
    
    <img src="{{$close}}" alt="Close image" class="w-[25px] h-[25px] mb-5">
</button>
