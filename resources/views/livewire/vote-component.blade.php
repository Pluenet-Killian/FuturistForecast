@php
     $upVote = asset('images/home/upVote.svg');
@endphp
<div>
    <button wire:click="vote" data-questionid="{{$questionId}}" data-username="{{$userId}}" class="flex items-center justify-center space-x-2">
        <img src="{{$upVote}}" alt="Close image" class="w-[19px] h-[19px] ">
        <p class="text-[15px] text-gray-700"> {{$totalVotes}}</p>
    </button>
</div>

