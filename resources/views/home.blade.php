@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3 class="mb-4">Hi, welcome  {{ Auth::user()->name }}</h3>
        <div class="card col-md-10">
            <div class="">
              <div class="mb-3 mt-4 text-center" style="color: blue;">
                <h3><b>{{ $response->form_response->definition->title }}</b></h3>
              </div>
              <form class="form" method="post" action="{{ route('store.user.claim') }}">
                @csrf
                <div class="justify-content-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($questions as $key => $question)
                    <div class="mb-3" style="width: 57rem;">
                        <div class="card-header mb-2">
                            {{$question->title}}
                        </div>
                            @if($question->type === "yes_no")
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="choice{{$key}}" id="choice{{$key}}" value="Yes">
                                <label class="form-check-label" for="choice{{$key}}">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="choice{{$key}}" id="choice{{$key}}" value="No">
                                <label class="form-check-label" for="choice{{$key}}">No</label>
                            </div>
                            @elseif($question->type === "multiple_choice")
                                @foreach ($question->choices as $choice)
                                <div class="form-check">
                                    <input class="form-check-input ads_Checkbox" type="checkbox" name="multiple" id="multiple" value="{{$choice->label}}">
                                    <label class="form-check-label" for="multiple">
                                        {{$choice->label}}
                                    </label>
                                </div>
                                @endforeach
                            @elseif($question->type === "short_text")
                            <div class="mb-3">
                                <input type="text" class="form-control" name="short_text{{$key}}" id="short_text{{$key}}" placeholder="Type here...">
                            </div>
                            @elseif($question->type === "long_text")
                            <div class="mb-3">
                                <input type="text" class="form-control" name="long_text{{$key}}" id="long_text{{$key}}" placeholder="Type here...">
                            </div>
                            @elseif($question->type === "phone_number")
                            <div class="mb-3">
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number">
                            </div>
                            @elseif($question->type === "email")
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                            </div>
                            @else

                            @endif
                    </div>
                    @endforeach
                    <button class="btn btn-primary form-control" type="button" id="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-js')
<script type="text/javascript">
        $(document).ready(function() { 
            console.log("hello");
            $('#submit').on('click', function(){
                let firstChoice = $("#choice0").is(":checked") ? "Yes" : "No";
                let secondChoice = $('#choice1').is(":checked") ? "Yes" : "No";
                let thirdChoice =  $('input[type=checkbox]:checked').map(function(_, el) {
                            return $(el).val();
                        }).get();
                let fourthChoice = $("#choice3").is(":checked") ? "Yes" : "No";
                let fifthChoice = $('#choice4').is(":checked") ? "Yes" : "No";
                let sixthChoice = $("#choice5").is(":checked") ? "Yes" : "No";
                let seventhChoice = $('#long_text6').val();
                let fname = $('#short_text7').val();
                let lname = $('#short_text8').val();
                let email = $('#email').val();
                let phone = $('#phone').val();
                let postcode = $('#short_text11').val();
                let address = $('#short_text12').val();
                let token = "{{ csrf_token() }}";
 
                $.ajax({
                    type: "POST",
                    url: "/upload/form",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        firstChoice,
                        secondChoice,
                        thirdChoice,
                        fourthChoice,
                        fifthChoice,
                        sixthChoice,
                        seventhChoice,
                        fname,
                        lname,
                        email,
                        phone,
                        postcode,
                        address,
                        token},
                    success: function(msg){
                        alert("succesfully added claim.");
                        window.location = '/success';
                    },
                    error: function(err){
                        alert("Something went wrong.. Please fill all field(s) accordingly");
                    }
                })
            });
        });
</script>  
@endsection
 