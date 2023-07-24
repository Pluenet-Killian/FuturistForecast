@extends('base')

@section('titre', 'FuturistForecast')

@section('javascript')
    @vite('resources/js/home/app.js')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        $close = asset('images/home/close.svg');
        $arrowDown = asset('images/home/arrowDown.svg');
        $home = asset('images/home/home.svg');
        $notification = asset('images/home/notification.svg');
        $pen = asset('images/home/pen.svg');
        $questionMark = asset('images/home/questionMark.svg');
        $search = asset('images/home/search.svg');
        $profile = asset('images/home/profile.svg');
        $logo = asset('images/home/logoFuturistForecast.jpg');
        $upVote = asset('images/home/upVote.svg');
        $downVote = asset('images/home/downVote.svg');
        $comment = asset('images/home/comment.svg');
        $star = asset('images/home/star.svg');
    @endphp
@endsection

    @section('content')
    @livewireScripts
    @livewireStyles 
    @include('components.nav-bar')

        
    </div>

    <div class=" px-2 py-2 space-x-2 mx-auto w-[45%] min-h-[50px] bg-white border  shadow-sm mt-6 flex items-center">
        <img src="{{$star}}" alt="star image">
        <p class="">Questions pour vous</p>
    </div>
    @foreach ($questions as $index => $question)

    <div  class="containerNewQuestion px-3 py-3 mx-auto w-[45%] min-h-[175px] max-h-[425px] bg-white border  shadow-sm {{$index === 0 ? "" : 'mt-4'}}">
        <div class="navUser flex items-center space-x-4 justify-between">
            <div class="flex items-center space-x-4">
                <div class="rounded-full flex items-center justify-center w-[35px] h-[35px] bg-gray-200">
                    <p>KP</p>
                </div>
                <div class="flex flex-col">
                    <p class="font-semibold">{{$question->user->name}}</p>
                    @if ($question->created_at->diffInMonths(Carbon\Carbon::now()) >=1)
                        <p class="text-gray-600">{{$question->created_at->format('d m Y')}}</p>
                    @else
                    <p class="text-gray-600">{{$question->created_at->format('d F')}}</p>
                    @endif
                </div>
            </div>
           
                @livewire('ignore-close-component', ['userId' => $question->user->id, 'questionId' => $question->id])
          
        </div>
        <div class="titleQuestion mt-2">
            <p class="font-semibold text-lg">{{$question->title}}</p>
        </div>

        <div class="relative">
            <div class="contentOverflow max-h-[70px] overflow-hidden">
                @foreach ($question->responses as $reponse)
                {{$reponse->content}}
                @endforeach
            </div>
            <p class="contentPlusClick hidden text-blue-600 font-semibold absolute right-0 bottom-0 cursor-pointer bg-white shadow-white z-[10] ">(Plus)</p>
        </div>


        <div class="mt-3 flex space-x-4 items-center">
            <p class="containerResponse px-3 py-1 border border-gray-700 rounded-full text-gray-700 cursor-pointer" data-questionid="{{$question->id}}" data-username="{{$question->user->name}}" data-questiontitle='{{$question->title}}' >Répondre</p>

            <form action="{{route('home.store')}}" method="post">
                @csrf
                <input type="hidden" name="action" value="ignore">
                <input type="hidden" name="user_id" value="{{$question->user->id}}">
                <input type="hidden" name="question_id" value="{{$question->id}}">
                <button type="submit" class="text-gray-700" data-questionid="{{$question->id}}" data-username="{{$question->user->name}}">Ignorer</button>
            </form>


                <div class="flex space-x-3 items-center">

           

            <div class="flex items-center space-x-2">
                <div class="flex items-center justify-center space-x-2 border-gray-400">
               
                    <img src="{{$comment}}" alt="Close image" class="w-[19px] h-[19px] ">
                    <p class="text-[15px] text-gray-700">76</p>
                </div>
            </div>
        </div>

            

        </div>
    </div>
    @endforeach
        
    @isset($question)

        @include('components.home.containerQuestion')
        @include('components.home.containerResponse')
        
    @endisset
    
@endsection