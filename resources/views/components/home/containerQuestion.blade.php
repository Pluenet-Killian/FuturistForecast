
<div id='inputContainer' class="hidden inset-0  justify-center items-center bg-black bg-opacity-50 z- w-full h-full z-20 ">
    <div  class="containerNewQuestion px-4 py-4 mx-auto w-[55%]  bg-white  border border-gray-400 shadow-sm ">

        <div class="navUser flex items-center space-x-4 justify-between">
            <div class="flex items-center space-x-4">
                <div class="rounded-full flex items-center justify-center w-[35px] h-[35px] bg-gray-200">
                    <p>KP</p>
                </div>
                <div class="flex flex-col">
                        <p class="userNameQuestion font-semibold">{{$question->user->name}}</p>
                   
                </div>
            </div>
            <p class="mb-2 mr-1 font-bold text-lg">X</p>
        </div>

        <div class="titleQuestion mt-3">
            <p class="font-semibold text-lg">{{$question->title}}</p>

        </div>
        
        <form action="{{route('home.store')}}" method="post" id="formNewResponse">
            @csrf
            <input type="hidden" name="action" value="response">
            
            <input type="hidden" name='question_id' class='question_id' value='{{$question->id}}'>
            <textarea name="content" id="content" placeholder="Écrivez votre réponse" class="w-full border-gray-700/40 py-2 focus:outline-none text-lg resize-none mt-1" rows="5"></textarea>
        <hr class="mt-12"/>

        <div class="flex space-x-4 w-full items-center justify-end mt-3">
            <p class="cursor-pointer" id="btnCancel">Annuler</p>
            <button type="submit" class="rounded-full px-5 py-2 bg-blue-700 flex items-center justify-center">
                <p class="text-white">Répondre</p>
            </button>
        </div>
    </form>
    </div>
</div>