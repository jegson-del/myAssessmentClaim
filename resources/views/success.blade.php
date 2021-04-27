@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-3">
                <a href="/home"><button class="btn btn-success"> Go back</button></a>
            </div>
            <div class="alert alert-info" role="alert">
                Successfully added.
            </div>
            <div>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Event ID</th>
                    <th scope="col">Type</th>
                    <th scope="col">Created Date</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($claims as $key => $claim)
                    <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$claim->event_id}}</td>
                    <td>{{$claim->event_type}}</td>
                    <td>{{$claim->created_at->diffForHumans()}}</td>
                    </tr>
                @endforeach
                </tbody>
                </table>
            <div>
            <div class="">
                {{ $claims->links() }}
            </div>
        </div>
    </div>
</div>
@endsection