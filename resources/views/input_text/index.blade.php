@extends('layouts.app')

@section('title', 'Input Text')

@section('content')


    <h2>Input Large Japanese Text into Database</h2>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('input-text.store') }}" method="POST">
        @csrf
        <textarea name="content" rows="10" cols="50" placeholder="Enter large Japanese text here"></textarea><br><br>
        <button type="submit">Submit Text</button>
    </form>
@endsection
