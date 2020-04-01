@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">{{$title}}</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form method="post" action="{{ $route . (isset($question->id) ? "/$question->id" : "") }}" enctype="multipart/form-data">
                            @csrf
                            @if($action == "edit") @method("PUT") @endif
                            <div class="form-group">
                                <label for="title">Title</label>
                                @error('title')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ $question->title ?? old('title') }}">
                            </div>

                            <div class="form-group">
                                <label for="title">Point</label>
                                @error('point')
                                <p class="invalid-feedback text-danger" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                                <input type="number" class="form-control" id="point" placeholder="Point" name="point" value="{{ $question->point ?? old('point') }}">
                            </div>

                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">{{ strtoupper($action) }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

