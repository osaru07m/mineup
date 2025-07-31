<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body class="min-vh-100 d-flex flex-column">
        <header class="sticky-top shadow">
            <h1 class="visually-hidden">{{ config('app.name') }}</h1>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a href="{{ route('home') }}" class="navbar-brand">{{ config('app.name') }}</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#headerNavbarContent" aria-controls="headerNavbarContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="headerNavbarContent">
                        @if (Auth::check())
                            @include('components.headers.auth')
                        @else
                            @include('components.headers.guest')
                        @endif
                    </div>
                </div>
            </nav>
        </header>
        <main class="flex-grow-1 container py-2{{ $mainAdditionalClass }}">
            {{ $slot }}
        </main>
        <footer>
            <nav class="navbar bg-body-tertiary">
                <div class="container-fluid justify-content-center">
                    <small class="text-muted">&copy; {{ date('Y') }} <a href="{{ config('app.project.source') }}" target="_blank" rel="noopener noreferrer" class="text-reset">{{ config('app.name') }}</a> - An OSS project as a modern successor to <a href="https://www.redmine.org/" target="_blank" rel="noopener noreferrer" class="text-reset">Redmine</a>. <span class="opacity-75">(Unofficial)</span></small>
                </div>
            </nav>
        </footer>
        <div id="javascript">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
            <script src="{{ asset('js/header.js') }}"></script>
            @stack('javascript')
        </div>
    </body>
</html>
