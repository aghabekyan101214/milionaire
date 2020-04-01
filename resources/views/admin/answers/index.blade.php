@extends('layouts.app')

@section('content')
   <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title">{{$title}}</h3>
                <a href="{{$route."/create"}}" class="btn btn-success m-b-30"><i class="fas fa-plus"></i> Add {{ strtolower($title) }}</a>

                {{--table--}}
                <div class="table-responsive">
                    <table id="datatable" class="display table table-hover table-striped nowrap" cellspacing="0"
                           width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Question</th>
                                <th>Title</th>
                                <th>Wright/Wrong</th>
                                <th>Options</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($answers as $key => $val)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $val->questions->title }}</td>
                                <td>{{ $val->title }}</td>
                                <td>{{ $val->is_wright_answer ? "Wright" : "Wrong" }}</td>

                                <td>

                                    <a href="{{$route."/".$val->id."/edit"}}" data-toggle="tooltip"
                                       data-placement="top" title="Edit" class="btn btn-info btn-circle tooltip-info">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form
                                        onsubmit="if(confirm('Do You Really Want To Delete The Record?') == false) return false;"
                                        style="display: inline-block" action="{{ $route."/".$val->id }}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <a href="javascript:void(0)">
                                            <button data-toggle="tooltip"
                                                    data-placement="top" title="Delete"
                                                    class="btn btn-danger btn-circle tooltip-danger"><i
                                                    class="fas fa-trash"></i></button>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-datatable')
    <script>
        $('#datatable').DataTable();
    </script>
@endpush




