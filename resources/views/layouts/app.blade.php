<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Word Frequency Analyzer')</title>
</head>
<body>
    <header>
        <h1>Word Frequency Analyzer</h1>

        <a href="{{ route('input-text.index') }}">
            <button type="button">Input to database</button>
        </a><br>
        <a href="{{ route('compare.index') }}">
            <button type="button">Compare with text</button>
        </a><br>
        <a href="{{ route('frequencies.index') }}">
            <button type="button">Go to Frequencies</button>
        </a>
        <!-- navigation bar -->
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>© 2024 Word Frequency Analyzer</p>
    </footer>
</body>
</html>
