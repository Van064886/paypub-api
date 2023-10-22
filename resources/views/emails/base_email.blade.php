<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <div class="bg-gray-100">
        <div class="p-4 md:p-8 lg:p-16">
            <div class="max-w-2xl mx-auto bg-white rounded shadow-lg">
                <div class="p-4 md:p-6 lg:p-8">
                    <p class="text-2xl font-semibold text-indigo-700 mb-4">
                        <a href="{{ config('app.url') }}" class="hover-underline">
                            {{ config('app.name') }}
                        </a>
                    </p>

                    <div class="text-base text-gray-700">
                        Bonjour
                        <p class="text-2xl font-semibold inline">@yield('username')</p>👋,
                        <br>
                        @yield('content')
                    </div>
                </div>
                <div class="bg-gray-200 text-gray-600 text-sm py-4 px-6">
                    Cordialement,<br>
                    {{ config('app.name') }}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
