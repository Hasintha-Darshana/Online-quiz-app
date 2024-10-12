<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form class="w-3/4" method="POST" action="{{route('update-question' , [$question->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="mb-5">
                            <label for="question" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Question</label>
                            <input type="text" name="question" id="question" value="{{$question->question}}" class="text-input" required />
                        </div>
                        @foreach($answers as $index => $answer)
                            <div class="mb-5">
                                <label for="answer{{$index + 1}}" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Answer {{$index + 1}}</label>
                                <input type="text" id="answer{{$index + 1}}" name="answer{{$index + 1}}" value="{{$answer}}"  class="text-input" required />

                                <input id="correct" name="correct" type="radio" value="answer{{$index + 1}}" class="radio-input"
                                    {{$correct_answer === 'answer'.($index + 1) ? 'checked' : ''}}
                                />
                                <label for="correct" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Correct</label>
                            </div>
                        @endforeach




                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update question</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
