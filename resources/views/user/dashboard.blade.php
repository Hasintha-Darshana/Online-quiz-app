<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Total Question {{$totalQuestionCount}} / Correct Answered Count {{$correctAnswersCount}}
        </h2>
    </x-slot>





    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                @if(session('message'))
                    <div class="text-blue-600">{{session('message')}}</div>
                @endif
                <div class="grid grid-cols-3 p-6 text-gray-900 dark:text-gray-100">

                    @foreach($questions as $question)
                        <div class="max-w-sm m-2 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <form action="{{route('answer-for-question', [$question->id])}} " method="POST">
                                @csrf
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{$question->question}}
                                </h5>


                                @foreach($question->answers as $index => $answer)
                                    <div class="m-4">
                                        <input type="radio" name="answer" id="answer" value="answer{{$index+1}}">
                                        <label for="answer" >{{$answer->answer}}</label>
                                    </div>
                                @endforeach


                                <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Answer

                                </button>
                            </form>

                        </div>

                    @endforeach



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
