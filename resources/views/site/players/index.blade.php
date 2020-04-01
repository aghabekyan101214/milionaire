@extends("layouts.site")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mt-4">
                <p class="text-center">Hello {{ Auth::user()->name }}</p>
            </div>
            <div class="col-xl-12 text-center">
                <a href="/game">
                    <button class="btn btn-primary">Start Game</button>
                </a>
            </div>
            <div class="col-xl-12 mt-5">
                <h3>Top Players</h3>
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Point</th>
                    </tr>
                    @foreach($topGamers as $top)
                        <tr>
                            <td>{{ $top->player_name }}</td>
                            <td>{{ $top->player_surname }}</td>
                            <td>{{ $top->point}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
