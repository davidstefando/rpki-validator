<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROV Tool | IDNIC (Indonesia Network Information Center)</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="w-full h-full flex flex-col items-center">
    <div class="w-full flex h-24 p-4 bg-idnic-blue border-b items-center">
        <img src="{{ asset('images/apjii-idnic-logo-white.png') }}">
    </div>

    <div class="w-full flex flex-row justify-center h-14 border-b @if(Route::is('rov.*')) bg-light-blue @else bg-orange-300 @endif">
        <a href="{{ route('rov.index') }}" class="flex items-center basis-80 italic justify-center cursor-pointer text-sm
        @if(Route::is('rov.*')) border-b-4 border-idnic-blue font-bold @else hover:font-bold @endif">
           <img class="mr-2" src="{{ asset('images/roa-icon.png') }}" alt=""> ROV Check
        </a>
        <a href="{{ route('dropRpkiInvalidCheck') }}" class="flex items-center basis-80 italic font-light justify-center cursor-pointer text-sm
         @if(Route::is('dropRpkiInvalidCheck')) border-b-4 border-orange-700 font-bold @else hover:font-bold @endif">
            <img class="mr-2" src="{{ asset('images/drop-invalid-icon.png') }}" alt=""> Drop Invalid Test
        </a>
    </div>

    @yield('content')


</div>
<div class="w-full fixed bottom-2 text-center">
    @yield('footer')
</div>
</body>
</html>
