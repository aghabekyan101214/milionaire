@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">{{$title}}</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form method="post" action="{{ $route . (isset($answer->id) ? "/$answer->id" : "") }}" enctype="multipart/form-data">
                            @csrf
                            @if($action == "edit") @method("PUT") @endif

                            <div class="form-group">
                                <label for="question">Choose Question</label>
                                @error('question_id')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <select name="question_id" id="question" class="form-control">
                                    <option value="">Select Question</option>
                                    @foreach($questions as $question)
                                        <option @if($question->id == old("question_id") || (isset($answer) && $answer->question_id == $question->id) ) selected @endif value="{{ $question->id }}">{{ $question->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Title</label>
                                @error('title')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ $answer->title ?? old('title') }}">
                            </div>

                            <div class="form-group">
                                <label for="title">Is Wright Answer</label>
                                @error('is_wright_answer')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <input style="width: 30px;" type="checkbox" class="form-control" @if(isset($answer->is_wright_answer) && $answer->is_wright_answer) checked @endif value="1" name="is_wright_answer">
                            </div>

                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">{{ strtoupper($action) }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

