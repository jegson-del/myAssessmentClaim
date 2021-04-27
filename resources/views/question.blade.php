@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-3">
                <h3><b>Event Form Claim ID: {{$answers->event_id}}</b></h3>
            <div>
            <div class="justify-content-center">
                @foreach ($questions as $key => $question)
                    <div class="mb-3" style="width: 57rem;">
                        <div class="card-header mb-2">
                            {{$question->title}}
                        </div>
                            @if($question->type === "yes_no")
                                @if($key == 0) 
                                    <div class="form-check">
                                         <p>Answer: {{$item1 == 0 ? 'No' : 'Yes'}}</p>
                                    </div>
                                @elseif($key == 1)
                                    <div class="form-check">
                                         <p>Answer: {{$item2 == 0 ? 'No' : 'Yes'}}</p>
                                    </div>
                                @elseif($key == 3)
                                    <div class="form-check">
                                         <p>Answer: {{$item3 == 0 ? 'No' : 'Yes'}}</p>
                                    </div>
                                @elseif($key == 4)
                                    <div class="form-check">
                                         <p>Answer: {{$item4 == 0 ? 'No' : 'Yes'}}</p>
                                    </div>
                                @elseif($key == 5)
                                    <div class="form-check">
                                         <p>Answer: {{$item5 == 0 ? 'No' : 'Yes'}}</p>
                                    </div>
                                @else
                                @endif
                            @elseif($question->type === "multiple_choice")
                                <div class="form-check">
                                    <p>Answer: {{$item6}}</p>
                                </div>
                            @elseif($question->type == "short_text" || $question->type == "long_text")
                                @if($key == 6)
                                    <div class="mb-3">
                                        <p>Answer: {{$item7}}</p>
                                    </div>
                                @elseif($key == 7)
                                    <div class="mb-3">
                                        <p>Answer: {{$item8}}</p>
                                    </div>
                                @elseif($key == 8)
                                    <div class="mb-3">
                                        <p>Answer: {{$item9}}</p>
                                    </div>
                                @elseif($key == 11)
                                    <div class="mb-3">
                                        <p>Answer: {{$item10}}</p>
                                    </div>
                                @elseif($key == 12)
                                    <div class="mb-3">
                                        <p>Answer: {{$item11}}</p>
                                    </div>
                                @else
                                @endif
                            @elseif($question->type === "phone_number")
                                <div class="mb-3">
                                    <p>Answer: {{$phone}}</p>
                                </div>
                            @elseif($question->type === "email")
                                <div class="mb-3">
                                    <p>Answer: {{$email}}</p>
                                </div>
                            @else

                            @endif
                    </div>
                    @endforeach
            
                    </form>
                </div>
        </div>
    </div>
</div>
@endsection