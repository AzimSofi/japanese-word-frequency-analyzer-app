@extends('layouts.app')

@section('title', 'Compare Text')

@section('content')


    <h2>Compare Japanese Text</h2>
    <ul>
        @foreach ($input_texts as $input_text)
            <li>
                <a href="{{ route('compare.show', $input_text->id) }}">
                    {{ Str::limit($input_text->content, 50) }} <!-- Display first 50 characters -->
                </a>
            </li>
        @endforeach
    </ul>
    <form action="{{ route('compare.store') }}" method="POST">
        @csrf
        <textarea name="content" rows="10" cols="50" placeholder="Enter large Japanese text here"></textarea><br><br>
        <button type="submit">Submit Text to be compared</button>
    </form>
@endsection
