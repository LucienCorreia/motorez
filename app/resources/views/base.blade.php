<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Motorez</title>

        <script src="https://cdn.tailwindcss.com"></script>
        <script
			  src="https://code.jquery.com/jquery-3.7.1.min.js"
			  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
			  crossorigin="anonymous"></script>
        @stack('head-scripts')
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#241b69',
                            secondary: '#00f88f',
                            contrast: '#ffffff',
                        }
                    }
                }
            }
        </script>
    </head>
    <body>
        @yield('content')
    </body>

    @stack('scripts')
</html>
