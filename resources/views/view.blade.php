@extends('layouts.app')

@section('content')
    <h2 class="bg-primary p-1 text-white">{{ $question->text }}</h2>

    <ul class="list-unstyled">
        @forelse ($question->answers->sortBy('created_at') as $answer)
            <li class="border-bottom pb-3 mt-3">
                {{ $answer->text }}
                @if ($answer->author)
                    – {{ $answer->author }}
                @endif

            </li>
        @empty
            <li>There are no answers, yet.</li>
        @endforelse
        </ul>

    <h2 class="bg-primary p-1 mt-3 text-white">Answer the question!</h2>

    <p>Before submitting an answer, always ask yourself whether your answer actually helps the questioner.</p>

    <form method="POST" action="/questions/{{ $question->id }}/answers">
        <div class="form-group">
            <textarea id="answer" name="answer" class="form-control @if ($errors->has('answer')) is-invalid @endif" placeholder="Your answer">{{ old('answer') }}</textarea>
            @error('answer')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input id="author" name="author" class="form-control" placeholder="Your name (optional)" value="{{ old('author') }}"/>
        </div>
        <button type="submit" class="btn btn-success">Answer question</button>
        {{ csrf_field() }}
    </form>
@stop
