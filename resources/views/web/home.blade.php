@extends('layout')

@section('content')
    <div class="flex mt-24 flex-col mx-8 md:mx-0 md:w-2/3 px-8 py-16 border shadow-md rounded-lg items-center border-l-8 border-l-light-blue">
    <h1 class="mt-4 text-3xl font-bold text-idnic-blue">RPKI ROV</h1>
    <h2 class="mt-2 text-xl font-bold text-idnic-blue">Route Origin Validation</h2>
    <p class="mx-4 mt-2 text-idnic-blue text-center">Validate your BGP Advertisement with ROA (Route Origin Authorization) Record</p>
    <form action="{{ route('rov.check') }}" method="POST" class="w-full px-10">
        @csrf
        <div class="w-full md:w-2/3 md:mx-auto flex flex-col md:flex-row justify-center mt-10 md:mt-16 md:mt-12">
            <div class="flex flex-col md:mx-4 md:basis-1/3">
                Prefix or IP Address
                <input type="text" name="prefix" class="px-2 py-2 border rounded-md mt-2
                @error('prefix') border-invalid @enderror" placeholder="e.g. 203.119.13.0/24" value="{{ $prefix ?? old('prefix') }}">
                @error('prefix')
                <div class="text-invalid text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col mt-4 md:mt-0 md:basis-1/3">
                Origin ASN (optional)
                <input type="text" name="as" class="px-2 py-2 border rounded-md mt-2
                 @error('as') border-invalid @enderror" placeholder="e.g. 63515" value="{{ $as ?? old('as') }}">
                @error('as')
                <div class="text-invalid text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col mt-4 md:mt-0 md:mx-4 md:basis-1/3">
                <p class="text-white">.</p>
                <button type="submit" class="px-10 py-2 md:mt-2 bg-idnic-blue text-white rounded-md">Validate</button>
            </div>
        </div>
    </form>

    @isset($roaValidation)
        <div class="mt-12 text-sm md:text-base">
            Validation results for <b>{{ $prefix }} - {{ $as }}</b>
        </div>

        @if($roaValidation["status"] == "valid")
            <div class="flex items-center justify-center px-6 mt-4 h-20 bg-valid rounded-full">
                <span class="text-white text-3xl">Valid</span>
            </div>
        @endif

        @if($roaValidation["status"] == "not-found")
            <div class="flex items-center justify-center px-6 mt-4 h-20 bg-idnic-blue rounded-full">
                <span class="text-white text-3xl">Not Found</span>
            </div>
        @endif

        @if($roaValidation["status"] == "invalid")
            <div class="flex items-center justify-center px-6 mt-4 h-20 bg-invalid rounded-full">
                <span class="text-white text-3xl">Invalid</span>
            </div>
        @endif
    @endisset
    </div>
@endsection

    @section('footer')
        <x-data-set-last-update/>
    @endsection
