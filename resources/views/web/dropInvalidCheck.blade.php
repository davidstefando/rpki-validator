@extends('layout')

@section('content')
        <div class="flex mt-24 mb-24 flex-col mx-8 md:mx-0 md:w-2/3 px-8 py-16 border shadow-md rounded-lg items-center border-l-8 border-orange-400">
            <h1 class="mt-4 text-3xl font-bold text-idnic-blue">RPKI ROV</h1>
            <h2 class="mt-2 text-xl font-bold text-idnic-blue">Drop BGP Invalid Test</h2>
            <p class="mx-4 mt-2 mb-8 text-idnic-blue text-center">Check if you have filtered Invalid BGP route with RPKI ROV</p>

            <span id="loading" class="flex text-idnic-blue font-light inline-block justify-center items-center text-center">
                Testing RPKI Drop Invalid
                <svg class="animate-spin ml-4 h-5 w-5 text-idnic-blue" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </span>
            <div id="validationResult" class="flex items-center justify-center content-center items-center hidden border-x-8 bg-light-gray p-8 rounded rounded-xl ">

            </div>
        </div>
        @vite('resources/js/app.js')
@endsection

@section('footer')
    <x-data-set-last-update/>
@endsection
