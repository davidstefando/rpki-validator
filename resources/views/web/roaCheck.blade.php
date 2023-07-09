@extends('layout')

@section('content')
    <form action="{{ route('roaCheck') }}" method="POST">
        @csrf
        <div class="w-2/3 flex flex-row justify-center mt-12">
            <div class="flex flex-col basis-1/3">
                Prefix or IP Address
                <input type="text" name="prefix" class="px-2 py-2 border rounded-md mt-2
                @error('prefix') border-invalid @enderror" placeholder="e.g. 203.119.13.0/24" value="{{ $prefix ?? old('prefix') }}">
                @error('prefix')
                <div class="text-invalid text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col basis-1/3 mx-20">
                Origin ASN (optional)
                <input type="text" name="as" class="px-2 py-2 border rounded-md mt-2
                 @error('as') border-invalid @enderror" placeholder="e.g. 63515" value="{{ $as ?? old('as') }}">
                @error('as')
                <div class="text-invalid text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col basis-1/3 justify-end">
                <button type="submit" class="px-10 py-2 bg-idnic-blue text-white rounded-md">Validate</button>
            </div>
        </div>
    </form>

    <div class="mt-12   italic">
        Results for 203.119.13.0/24 - 63515
    </div>

    <div class="flex items-center justify-center mt-4 h-20 w-64 bg-valid rounded-full">
        <span class="text-white text-3xl">Valid</span>
    </div>
@endsection

@section('footer')
    <span class="text-gray-400 text-sm">Last updated </span>
@endsection
