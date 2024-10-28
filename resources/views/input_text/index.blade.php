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

    <textarea id="largeText" rows="10" cols="50" placeholder="Enter large Japanese text here"></textarea>
    <button id="submitText">Submit Text</button>

    <script>
        document.getElementById('submitText').addEventListener('click', function() {
            const text = document.getElementById('largeText').value;
            const chunkSize = 2000; // Break text into chunks of 2000 characters
            for (let i = 0; i < text.length; i += chunkSize) {
                let chunk = text.substring(i, i + chunkSize);
                sendChunk(chunk);
            }
        });

        function sendChunk(chunk) {
            fetch('{{ route('input-text.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        content: chunk
                    })
                })
                .then(response => response.json())
                .then(data => console.log('Chunk submitted:', data))
                .catch(error => console.error('Error:', error));
        }
    </script>


    {{-- <div>
        <div>
            <form action="{{ route('input-text.store') }}" method="POST">
                @csrf
                <textarea name="content" rows="10" cols="50" placeholder="Enter large Japanese text here"></textarea><br><br>
                <button type="submit">Submit Text</button>
            </form>

        </div>
        <div style="margin-top: 3rem">
            Or submit a txt file instead here:
    <form action="{{ route('input-text.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">Upload a .txt file:</label><br><br>
        <input type="file" name="file" id="file" accept=".txt"><br><br>
        <button type="submit">Submit File</button>
    </form>
        </div>
    </div> --}}

@endsection
