<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ $page->title ? $page->title . ' – ': '' }}{{ $page->config['site']['name'] }}</title>

    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#243377">
    <meta name="apple-mobile-web-app-title" content="{{ $page->config['site']['name'] }}">
    <meta name="application-name" content="{{ $page->config['site']['name'] }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    @section('meta')
        <meta name="description" content="{{ $page->description ?? $page->config['site']['description'] }}">
        <meta itemprop="name" content="{{ $page->title ? $page->title . ' – ': '' }}{{ $page->config['site']['name'] }}">
        <meta itemprop="description" content="{{ $page->description ?? $page->config['site']['description'] }}">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="{{ $page->title ? $page->title . ' – ': '' }}{{ $page->config['site']['name'] }}">
        <meta name="twitter:description" content="{{ $page->description ?? $page->config['site']['description'] }}">
        <meta name="og:title" content="{{ $page->title ? $page->title . ' – ': '' }}{{ $page->config['site']['name'] }}">
        <meta name="og:description" content="{{ $page->description ?? $page->config['site']['description'] }}">
        <meta name="og:type" content="website">
    @endsection

    <link rel="stylesheet" href="{{ mix('css/app.css', 'assets/build') }}">

    <style>
        @foreach($page->config['style'] as $class => $attributes)
        {!! $class !!} {
            @foreach($attributes as $name => $value)
                @if(!empty(trim($value)))
                    @if($name == 'background-image')
                        {!! $name !!}: url("{!! $value !!}");
                    @else
                        {!! $name !!}: {!! $value !!}{{ ($name == 'border-radius' OR $name == 'border-width' OR $name == 'font-size') ? 'px' : ''}};
                    @endif
                @endif
            @endforeach
        }
        @endforeach
    </style>


</head>
<body>
<div class="container-fluid">
    <div class="row wrapper">
        <aside class="col-12 col-md p-0">
            <nav style="top:0"
                 class="position-sticky navbar navbar-expand-md navbar-light align-items-center align-items-md-start flex-md-column flex-row">
                <a class="navbar-brand" href="/">{{ $page->config['site']['name'] }}</a>
                <a href class="navbar-toggler" data-toggle="collapse" data-target=".sidebar">
                    <span class="navbar-toggler-icon"></span>
                </a>
                <div class="collapse navbar-collapse sidebar">
                    <ul class="flex-column navbar-nav w-100 justify-content-between">
                        @foreach ($page->menu as $menuItem)
                            <li class="nav-item py-1">
                                @if($menuItem['external'])
                                    <a class="nav-link p-0 d-inline" target="_blank" href="{{ $menuItem['url'] }}">{{ $menuItem['name'] }}</a>
                                @else
                                    <a class="nav-link p-0 d-inline {{ $page->active($menuItem['page']) }}" href="{{ $menuItem['page'] }}">{{ $menuItem['name'] }}</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </aside>
        <main class="col-12 col-md py-3">
            @if($page->title AND $page->show_title)
                <h1>{{ $page->title }}</h1>
            @endif
            @yield('content')
        </main>
    </div>
</div>

<script src="{{ mix('js/app.js', 'assets/build') }}" type="text/javascript"></script>
</body>
</html>
