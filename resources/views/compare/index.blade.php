@extends('layouts.app')

@section('title', 'Compare Text')

@section('content')
    <a href="{{ route('frequencies.index') }}">
        <button type="button">Go to Frequencies</button>
    </a>

    <h2>Compare Japanese Text</h2>

    <form action="{{ route('compare.store') }}" method="POST">
        @csrf
        <textarea name="content" rows="10" cols="50" placeholder="Enter large Japanese text here"></textarea><br><br>
        <button type="submit">Submit Text to be compared</button>
    </form>
@endsection
