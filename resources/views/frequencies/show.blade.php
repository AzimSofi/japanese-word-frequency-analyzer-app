@extends('layouts.app')

@section('title', 'Word Frequency Analysis')

@section('content')
    <h2>Word Frequency for Text</h2>

    <p><strong>Text ID:</strong> {{ $inputText->id }}</p>
    <p><strong>Content:</strong> {{ $inputText->content }}</p>

    <h2>Word Frequencies</h2>

    <table border="1">
        <thead>
            <tr>
                <th>Word</th>
                <th>Frequency</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wordFrequencies as $wordFrequency)
                <tr>
                    <td>{{ $wordFrequency->word }}</td>
                    <td>{{ $wordFrequency->frequency }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
