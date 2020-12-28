@extends('layouts.app')

@section('content')
    <h2 class="bg-primary p-1 text-white">New question</h2>

    <p>You can ask anything here. But I recommend to keep the question concise to increase the change to get a relevant and helpful answer.</p>

    <form method="POST" action="/questions">
        <div class="form-group">
            <textarea id="question" name="question" class="form-control @if ($errors->has('question')) is-invalid @endif" placeholder="{{ $placeholderQuestion }}">{{ old('question') }}</textarea>
            @error('question')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Ask question</button>
        {{ csrf_field() }}
    </form>

    <h2 class="bg-primary p-1 mt-3 text-white">Questions</h2>

    <ul class="list-unstyled">
    @forelse ($questions as $question)
        <li class="d-flex justify-content-between align-items-center border-bottom pb-3 mt-3">
            <a href="/questions/{{ $question->id }}">{{ $question->text }}</a>
            <div class="badge badge-primary">Answers: {{ count($question->answers) }}</div>
        </li>
    @empty
        <li>There are no questions, yet.</li>
    @endforelse
    </ul>
@stop
