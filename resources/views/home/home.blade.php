@extends('base')

@section('titre', 'FuturistForecast')

@section('javascript')
    @vite('resources/js/home/app.js')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')

    @include('components.nav-bar')

        <div  class="containerNewQuestion px-3 py-4 mx-auto w-[50%] h-[110px] bg-white mt-4 border border-gray-400 shadow-sm">

            <form action="{{route('home.store')}}" method="post" id="formNewQuestion" class="">
                @csrf
                @error('title')
               <p>{{$message}}</p>
                 @enderror
                <input class="px-3 focus:outline-none w-full rounded-full border border-gray-600 bg-[#F1F2F2]/40 h-[40px] flex items-center cursor-pointer text-black hover:bg-[#F1F2F2]" placeholder="Que souhaitez-vous demander ou partager ?" name='title'>
                

                <div class="flex justify-between items-center w-full mt-4">
                    <div class="flex items-center justify-center w-full cursor-pointer">
                        <p>Demander</p>
                    </div>
                    <div class="flex items-center justify-center w-full cursor-pointer">
                        <p>Répondre</p>
                    </div>
                    
            </div>
        </div>
    </div>



    @foreach ($questions as $question)

    <div  class="containerNewQuestion px-3 py-3 mx-auto w-[50%] min-h-[175px] max-h-[425px] bg-white mt-6 border border-gray-400 shadow-sm">
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
            <p class="mb-2 mr-1 font-bold text-lg">X</p>
        </div>
        <div class="titleQuestion mt-2">
            <p class="font-semibold text-lg">{{$question->title}}</p>
        </div>

        <p class="text-gray-700 font-semibold text-[14px] mt-1">109 réponses</p>
        <div class="mt-2 flex space-x-4">
            <button class="px-3 py-1 border border-gray-700 rounded-full text-gray-700">Répondre</button>
            <button class="text-gray-700">Ignorer</button>
        </div>
    </div>
    @endforeach


        
        {{-- @include('components.home.containerQuestion') --}}
        
@endsection