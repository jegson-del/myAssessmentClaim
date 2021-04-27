<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use Carbon\Carbon;
use App\Models\Claim;

class SearchClaimController extends Controller
{
    public function search(Request $request)
    {
        $json = file_get_contents(base_path('response.json'));

        $response = json_decode($json, FALSE);
        
        $questions = $response->form_response->definition->fields;
 
        $answers = Claim::with("answer")->where("event_id", $request->eventId)->first();

        if (!$answers) return redirect()->back()->withErrors(['Claim not found']);;
        
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
        
        return view('search', compact(
            'questions', 'answers', 'item1', 
            'item2', 'item3', 'item4',
            'item5', 'item6', 'item7',
            'item8', 'item9', 'item10',
            'item11', 'email', 'phone'
        ));
    }
}
