<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Job;
use App\Models\Job_inquiries;
use Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function is_employee_apply($id = null)
    {

        $id = Auth::id();
        $jobs = Job::where(['employer_id' => $id])->get();
        $data = [];

        foreach ($jobs as $val) {
            foreach ($val->inquery as $value) {
                if ($value->employee_id) {
                    $data[] = $value->employee_id;
                }
            }
        }



        $data = array_unique($data);
        if ($id) {
            $chat = Chat::where(['employee_id' => $id])->get();
            return view('Chat.chat', ['employerdata' => employerData(), 'employee_id' => $data, 'chat' => $chat]);
        }
        return view('Chat.chat', ['employerdata' => employerData(), 'employee_id' => $data]);

    }

}
