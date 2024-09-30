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
                            <input type="text" name="question" value="{{$question->question}}" id="question" class="text-input"  required />
                        </div>
                        <div class="mb-5">
                            <label for="answer1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Answer 1</label>
                            <input type="text" name="answer1" value="{{$answer1}}" id="answer1" class="text-input" required />
                            <input id="correct" name="correct" type="radio" value="answer1" class="radio-input"
                                {{$correct_answer === 'answer1' ? 'checked' : ''}}
                            />
                            <label for="correct" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Correct</label>
                        </div>
                        <div class="mb-5">
                            <label for="answer2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Answer 2</label>
                            <input type="text" name="answer2" value="{{$answer2}}" id="answer2" class="text-input" required />
                            <input id="correct" name="correct" type="radio" value="answer2" class="radio-input"
                                {{$correct_answer === 'answer2' ? 'checked' : ''}}
                            />
                            <label for="correct" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Correct</label>
                        </div>
                        <div class="mb-5">
                            <label for="answer3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Answer 3</label>
                            <input type="text" name="answer3" value="{{$answer3}}" id="answer3" class="text-input" required />
                            <input id="correct" name="correct" type="radio" value="answer3" class="radio-input"
                                {{$correct_answer === 'answer3' ? 'checked' : ''}}
                            />
                            <label for="correct" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Correct</label>
                        </div>
                        <div class="mb-5">
                            <label for="answer4" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Answer 4</label>
                            <input type="text" name="answer4" value="{{$answer4}}" id="answer4" class="text-input" required />
                            <input id="correct" name="correct" type="radio" value="answer4" class="radio-input"
                                {{$correct_answer === 'answer4' ? 'checked' : ''}}
                            />
                            <label for="correct" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Correct</label>
                        </div>



                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update question</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>