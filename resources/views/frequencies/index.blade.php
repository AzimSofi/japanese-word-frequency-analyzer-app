@extends('layouts.app')

@section('title', 'Choose Text for Word Frequency Analysis')

@section('content')
    <h2>Choose a Text to View Word Frequencies</h2>

    <ul>
        <a href="{{ route('frequencies.showAll') }}">
            全部
        </a>
        @foreach ($texts as $text)
            <li>
                <a href="{{ route('frequencies.show', $text->id) }}">
                    {{ Str::limit($text->content, 50) }} <!-- Display first 50 characters -->
                </a>
            </li>
        @endforeach
    </ul>
@endsection
