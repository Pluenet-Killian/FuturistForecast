@extends('base')

@section('titre', 'FuturistForecast')

@section('javascript')
    @vite('resources/js/home/app.js')
@endsection

@section('content')

    @include('components.nav-bar')

        <div  class="containerNewQuestion px-3 py-4 mx-auto w-[60%] h-[110px] bg-white mt-6 border border-gray-400 shadow-sm">
                <div id="questionBar" class="questionBar w-full rounded-full border border-gray-600 bg-[#F1F2F2]/40 h-[40px] flex items-center cursor-pointer hover:bg-[#F1F2F2]">
                    <p class="ml-3">Que souhaitez-vous demander ou partager ? </p>
                </div>
                <div class="flex justify-between items-center w-full mt-4">
                    <div class="flex items-center justify-center w-full">
                        <p>Demander</p>
                    </div>
                    <div class="flex items-center justify-center w-full">
                        <p>Demander</p>
                    </div>
                    <div class="flex items-center justify-center w-full">
                        <p>Demander</p>
                    </div>
            </div>
        </div>

        @include('components.home.containerQuestion')


        <script>
        </script>
@endsection