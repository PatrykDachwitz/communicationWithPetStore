<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@lang("page.title")</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
    <main>

        @yield("header")

        @if(session('errorsCustom'))
            @include("component.communicat.error", [
                'message' => $data
            ])
        @endif

        @if(session('success'))
            @include("component.communicat.success", [
                'message' => __("page.successUpdate")
            ])
        @endif

        @yield("content")
    </main>
</body>
</html>
