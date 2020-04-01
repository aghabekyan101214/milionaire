@extends("layouts.site")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 mt-4">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        @for($i = 0; $i < count($questions); $i ++)
                            <a class="nav-item nav-link @if($i == 0) active" @endif id="nav-{{ $i }}-tab" data-toggle="tab" href="#nav-{{ $i }}" role="tab" aria-controls="nav-{{ $i }}" aria-selected="true">Question {{ $i + 1 }}</a>
                        @endfor
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    @foreach($questions as $bin => $question)
                        <div class="tab-pane fade @if($bin == 0) show active @endif" id="nav-{{ $bin }}" role="tabpanel" aria-labelledby="nav-{{ $bin }}-tab">
                            <table class="table">
                                <tr>
                                    <th class="text-center">{{ $question->title }}</th>
                                </tr>
                                @foreach($question->answers as $answer)
                                    <tr>
                                        <td>
                                            <label><input type="radio" class="answer" onclick="collectAnswer('{{ $question->id }}', '{{ $answer->id }}')" name="answer_id-{{ $question->id }}" value="{{ $answer->id }}">{{ $answer->title }}</label>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <button class="btn btn-primary submit" onclick="checkRadios('{{ count($questions) }}')">Submit</button>
                <button class="btn btn-primary play-again" style="display: none;" onclick="location.reload()">Play Again</button>
                <h4 class="point mt-3"></h4>
            </div>
        </div>
    </div>
    @push("footer")
        <script src="{{ asset("assets/site/js/script.js") }}"></script>
    @endpush

@endsection
