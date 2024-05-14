<html>

<head>
    <title>{{ ($title ? $title . ' - ' : '') . config('app.name') }}</title>

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif !important;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11" !important;
        }
    </style>

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
    {{ $slot }}

    @stack('scripts')
</body>

</html>
