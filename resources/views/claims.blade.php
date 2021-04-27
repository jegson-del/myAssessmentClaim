@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h4> List Of Claims<h4>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Event ID</th>
                    <th scope="col">Type</th>
                    <th scope="col">Date Created</th>
                    <th scope="col">Link</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($claims as $key => $claim)
                    <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$claim->event_id}}</td>
                    <td>{{$claim->event_type}}</td>
                    <td>{{$claim->created_at->diffForHumans()}}</td>
                    <td><a href="{{ route('show.claim.event', $claim->event_id) }}"><button class="btn btn-info">View Claims</button></a></td>
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