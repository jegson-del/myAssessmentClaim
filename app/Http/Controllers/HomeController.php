<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\Answer;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $json = file_get_contents(base_path('response.json'));

        $response = json_decode($json, FALSE);
        
        $questions = $response->form_response->definition->fields;

        $answers = $response->form_response->answers;

        // dd($response);

        return view('home', compact('response', 'questions', 'answers'));
    }

    public function store(Request $request)
    {
        $len = count($request->all());

        $dt = Carbon::now();
        $choices = implode(",", $request->thirdChoice);

        $data = [
            'user_id' => auth()->user()->id,
            'event_id' => uniqid(),
            "event_type" => 'form_response',
            "form_response" => '{
                "form_id": "'.uniqid().'",
                "token": "'.$request->token.'",
                "landed_at": "'.$dt->toDateTimeString().'",
                "submitted_at": "'.$dt->toDateTimeString().'",
                "hidden": {},
            }'
        ];

        $response = Claim::create($data);
        
        $arry = array(
        'boolean' => array(
            $request->firstChoice, 
            $request->secondChoice, 
            $request->fourthChoice, 
            $request->fifthChoice, 
            $request->sixthChoice), 
        'choice' => $choices, 
        'text' => array(
            $request->seventhChoice, 
            $request->fname, 
            $request->lname,  
            $request->postcode, 
            $request->address
        ),
        'phone_number' => $request->phone,
        'email' => $request->email
        );

        foreach ($arry as $key => $value){

            if ($key == 'boolean')
            {
                foreach ($value as $val) {
                    $ans = [
                        "event_id" => $response->event_id,
                        "type" => "boolean",
                        "boolean" => $val == "Yes" ? true : false,
                        "field" => '{
                            "id": "1ZgNISlWpEdi",
                            "type": "yes_no",
                            "ref": "4cf6e5d2-e7ec-4bf5-96e3-7d8b1c249549"
                        }'
                    ];
                    $answers = Answer::create($ans);
                }
            }
            if($key == 'choice')
            {
                $ans = [
                    "event_id" => $response->event_id,
                    "type" => "choice",
                    "choice" => '{
                        "label": "'.$choices.'"
                    }',
                    "field" => '{
                        "id" => "M3kU4oIvll0H",
                        "type" => "multiple_choice",
                        "ref" => "f782a5a8-4e6f-4559-bf87-81c6e36be572"
                    }'
                ];
                $answers = Answer::create($ans);
            }
            if($key == 'text')
            {
                foreach($value as $val){
                    $ans = [
                        "event_id" => $response->event_id,
                        "type" => "text",
                        "text" => $val,
                        "field" => '{
                            "id" => "Bl4R7gWB9PiS",
                            "type" => "long_text",
                            "ref" => "47674f81-4454-4e92-bad0-bb02bd4b9bc8"
                        }'
                    ];
                    $answers = Answer::create($ans);
                }
            }
            if($key == 'phone_number')
            {
                $ans = [
                    "event_id" => $response->event_id,
                    "type" => "phone_number",
                    "phone_number" => $value,
                    "field" => '{
                        "id": "Y8bxbQfyp9LD",
                        "type": "phone_number",
                        "ref": "295e8c5d-6ede-4698-902c-6bec74dd5503"
                    }'
                ];
                $answers = Answer::create($ans);
            }
            if($key == 'email')
            {
                $ans = [
                    "event_id" => $response->event_id,
                    "type" => "email",
                    "email" => $value,
                    "field" => '{
                        "id": "d82LBTQ7bavg",
                        "type": "email",
                        "ref": "18d0d325-a1e2-4a7c-957a-031c57b0b2fd"
                    }'
                ];
                $answers = Answer::create($ans);
            }
        }

        return response()->json(['message' => "Successfully submitted."], 200);
    }

    public function event(Request $request, $event)
    {
        $json = file_get_contents(base_path('response.json'));

        $response = json_decode($json, FALSE);
        
        $questions = $response->form_response->definition->fields;
 
        $answers = Claim::with("answer")->where("event_id", $event)->first();
        
        $item1  = $answers->answer[0]->boolean;
        $item2  = $answers->answer[1]->boolean;
        $item3  = $answers->answer[2]->boolean;
        $item4  = $answers->answer[3]->boolean;
        $item5  = $answers->answer[4]->boolean;
        $item6 = $answers->answer[5]->choice;
        $item7 = $answers->answer[6]->text;
        $item8 = $answers->answer[7]->text;
        $item9 = $answers->answer[8]->text;
        $item10 = $answers->answer[9]->text;
        $item11 = $answers->answer[10]->text;
        $phone = $answers->answer[11]->phone_number;
        $email = $answers->answer[12]->email;
        
        return view('question', compact(
            'questions', 'answers', 'item1', 
            'item2', 'item3', 'item4',
            'item5', 'item6', 'item7',
            'item8', 'item9', 'item10',
            'item11', 'email', 'phone',
        ));
    }

    public function show()
    {
        $claims = Claim::where("user_id", auth()->user()->id)->orderBy('id', 'DESC')->paginate(5);
        return view('claims', compact('claims'));
    }
    public function success()
    {
        $claims = Claim::where("user_id", auth()->user()->id)->orderBy('id', 'DESC')->paginate(5);
        return view('success', compact('claims'));
    }
}
