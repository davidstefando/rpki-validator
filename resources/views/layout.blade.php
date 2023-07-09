<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body>
<div class="w-full h-full flex flex-col items-center">
    <div class="w-full flex h-24 p-4 bg-idnic-blue border-b items-center">
        <img src="{{ asset('images/apjii-idnic-logo-white.png') }}">
    </div>

    <div class="w-full flex flex-row justify-center h-14 border-b bg-light-blue">
        <div class="flex items-center basis-80 italic justify-center border-b-4 cursor-pointer border-idnic-blue font-bold">
            <img class="mr-2" src="{{ asset('images/roa-icon.png') }}" alt=""> Route Validator
        </div>
        <div class="flex items-center basis-80 italic font-light justify-center border-b-4 border-transparent cursor-pointer hover:border-b-4 hover:border-idnic-blue">
            <img class="mr-2" src="{{ asset('images/drop-invalid-icon.png') }}" alt=""> Drop Invalid Test
        </div>
    </div>

    @yield('content')


</div>
<div class="w-full fixed bottom-2 text-center">
    @yield('footer')
</div>
</body>
</html>
