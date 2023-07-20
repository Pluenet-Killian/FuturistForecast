
<div id='inputContainerQuestion' class="hidden inset-0  justify-center items-center bg-black bg-opacity-50 z- w-full h-full z-20 ">
    <div  class="containerNewQuestion px-4 py-4 mx-auto w-[55%]  bg-white  border border-gray-400 shadow-sm relative ">

      
        <img src="{{$close}}" alt="image close" id="btnCloseQuestion" class=" w-[28px] h-[28px] absolute right-2 top-2  cursor-pointer">
        <p class="text-2xl font-semibold ">Ajouter une question</p>
        <form action="{{route('home.store')}}" method="post" id="formNewResponse" class="mt-4">
            @csrf
            <input class="outline-none border-b-2 border-black/20 py-2 w-full" placeholder="Que souhaitez-vous demander ou partager ?" name='title'>


        <div class="flex space-x-4 w-full items-center justify-end mt-16">
            <p class="cursor-pointer" id="btnCancelQuestion">Annuler</p>
            <button type="submit" class="rounded-full px-5 py-2 bg-blue-700 flex items-center justify-center">
                <p class="text-white">Ajouter une question</p>
            </button>
        </div>
    </form>
    </div>
</div>