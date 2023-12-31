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
        $petitPoints = asset('images/home/petitPoints.svg');
        $postImages = asset('images/home/postImages.svg');
        $trash = asset('images/home/trash.svg');
    @endphp
@endsection

    @section('content')
    @livewireScripts
    @livewireStyles 

    @include('components.nav-bar')

    
        <div  class="containerNewQuestion px-3 py-4 mx-auto w-[45%] h-[110px] bg-white mt-4 border shadow-sm">

            <form action="{{route('home.store')}}" method="post" id="formNewQuestion" class="containerQuestion">
                @csrf
                <input type="hidden" name="action" value="question">
                @error('title')
               <p>{{$message}}</p>
                 @enderror
                <div class="px-3 focus:outline-none w-full rounded-full border border-gray-600 bg-[#F1F2F2]/40 h-[40px] flex items-center cursor-pointer text-black hover:bg-[#F1F2F2]" placeholder="Que souhaitez-vous demander ou partager ?" name='title'>
                   <p> Que souhaitez-vous demander ou partager ?</p>
                </div>
            </form>

                <div class="flex justify-between items-center w-full mt-4">
                    <div class="containerQuestion flex items-center justify-center w-full cursor-pointer space-x-2">
                        <img src="{{$questionMark}}" alt="questionMark image" class="w-[18px] h-[18px] ">
                        <p>Demander</p>
                    </div>
                    <a href="/home/response" class="flex items-center justify-center w-full cursor-pointer space-x-2">
                            <img src="{{$pen}}" alt="questionMark image" class="w-[18px] h-[18px] ">
                            <p>Répondre</p>
                    </a>
            
            </div>
        </div>
    @isset($recentQuestionsOfMe)
        
    <div class="containerNewQuestion relative px-3 py-2 mx-auto w-[45%] max-h-[135px] bg-white  border  shadow-sm cursor-pointer">
        <p class="text-gray-600 text-[15px] ">
            Vous avez récemment demandé
        </p>
        <p class="font-semibold text-lg">{{$recentQuestionsOfMe->title}}</p>
        <div class=" flex justify-end w-full">
            <div class="absolute right-4 bottom-3">

                <img class="petitPoints" src="{{$petitPoints}}" alt="questionMark image" class="w-[24px] h-[24px] bottom-2 right-3 ">
                <div class="petitPointsContainer w-[250px] h-[175px] bg-white shadow-md hidden   transform translate-x-[-50%] left-[50%] z-[50] border border-gray-200 py-3 px-3 top-4">
                    <form action="{{route("home.destroy")}}" method="post">
                        @csrf
                        @method('DELETE')
                      <input type="hidden" name="id" value="{{$recentQuestionsOfMe->id}}">
                        <div class="flex items-center space-x-2">
                            <img src="{{$trash}}" alt="questionMark image" class="w-[25px] h-[25px] ">
                            <button type="submit">
                                Supprimer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endisset

    
    @foreach ($questions as $question)
    <div  class="containerNewQuestion px-3 py-3 mx-auto w-[45%] min-h-[175px]  bg-white mt-6 border  shadow-sm">
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
            <div class="  overflow-hidden">
                @foreach ($question->responses as $response)
                <div class="relative contentOverflow">
                    <p>{{$response->content}}</p>
                    <p class="contentPlusClick hidden text-blue-600 font-semibold absolute right-0 bottom-0 cursor-pointer bg-white shadow-white z-[10] ">(Plus)</p>
                </div>
                <img class="mt-2 w-full max-h-[350px]" src="{{asset('storage/home/'.$response->image_path)}}" alt="">

                @endforeach
            </div>
          

           
        </div>


        <div class="mt-3 flex space-x-4 items-center">
            {{-- <p class="containerResponse px-3 py-1 border border-gray-700 rounded-full text-gray-700 cursor-pointer" data-questionid="{{$question->id}}" data-username="{{$question->user->name}}" data-questiontitle='{{$question->title}}' >Répondre</p>

            <form action="{{route('home.store')}}" method="post">
                @csrf
                <input type="hidden" name="action" value="ignore">
                <input type="hidden" name="user_id" value="{{$question->user->id}}">
                <input type="hidden" name="question_id" value="{{$question->id}}">
                <button type="submit" class="text-gray-700" data-questionid="{{$question->id}}" data-username="{{$question->user->name}}">Ignorer</button>
            </form> --}}


                <div class="flex space-x-3 items-center">

            <div  data-questionid="{{$question->id}}" data-username="{{$question->user->name}}" data-questiontitle='{{$question->title}}' >
               
                <div class="flex items-center space-x-3 bg-gray-100/60 px-3 py-1 border border-gray-700 rounded-full text-gray-700">
                    <div class="flex items-center justify-center space-x-2 border-gray-400 border-r-2 pr-3">
                        @livewire('vote-component', ['userId' => Auth::id(), 'questionId' => $question->id, 'voteValue' => 1, 'totalVotes' => $question->totalVotes])
                        <button wire:click="vote"></button>
                    </div>
                    <img src="{{$downVote}}" alt="Close image" class="w-[19px] h-[19px]">
                </div>
                
                
            </button>

            </div>

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