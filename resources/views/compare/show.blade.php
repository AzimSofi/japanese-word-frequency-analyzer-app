@extends('layouts.app')

@section('title', 'Compare Text')

@section('content')


    <h2>Compare Japanese Text</h2>

    {{ $input_text->content}}
    <br>
    <h2>Tokenized Words with Frequencies and Colors</h2>
    <p>
        @foreach ($wordFrequenciesDict as $wordData)<span style="color: {{ $wordData['color'] }};">{{ $wordData['word'] }}{{-- ({{ $wordData['frequency'] }}) --}}</span>@endforeach
    </p>

@endsection
