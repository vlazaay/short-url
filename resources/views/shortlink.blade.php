@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1>Short links creator</h1>
        <form method="post" action="{{route('generate.short.link.post')}}">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="link" class="form-control" placeholder="URL">
                <input type="text" name="limit" class="form-control" placeholder="limit">
                <input type="time" name="lifetime" class="form-control" placeholder="lifetime">
                <div class="input-group-append">
                   <button class="btn btn-success" type="submit">Save link</button>
                </div>
            </div>

        </form>

    <div class="card-body">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>id</th>
                    <th>short link</th>
                    <th>link</th>
                    <th>count</th>
                    <th>limit</th>
                    <th>lifetime</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shortLinks as $link)
                    <tr>
                        <td>{{$link->id}}</td>
                        <td>
                            <a href="{{ route('short.link', $link->code) }}"> {{ route('short.link', $link->code) }}
                            </a>
                        </td>
                        <td>{{$link->link}}</td>
                        <td>{{$link->count}}</td>
                        <td>{{$link->limit}}</td>
                        <td>{{$link->lifetime}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection
