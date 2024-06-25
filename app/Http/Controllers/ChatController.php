<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Chat;
use App\Models\Employee;
use App\Models\Job;
use App\Models\Job_inquiries;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function is_employee_apply()
    {

        // dd($employee_id);

        $id = Auth::id();
        $jobs = Job::where(['employer_id' => $id,])->get();

        $data = [];

        foreach ($jobs as $val) {
            foreach ($val->inquery as $value) {
                if ($value->employee_id) {
                    $data[] = $value->employee_id;
                }
            }
        }

        $data = array_unique($data);

        if (isset($data)) {
            $id = $data[0] ?? null;
            $chat = Chat::where(['employee_id' => $id])->get();
            $employee = User::find($id);

        }
        return view('Chat.chat', ['employerdata' => employerData(), 'chats' => $chat, 'employee_id' => $data, 'employee' => $employee]);

    }

    public function employee_message()
    {

        // dd($employee_id);

        $id = Auth::id();
        $jobs = Job_inquiries::where(['employee_id' => $id,])->get();

        $data = [];

        foreach ($jobs as $val) {
            $data[] = $val->jobs->employer_id;
        }
        $data = array_unique($data);
        if (isset($data)) {
            $id = $data[0] ?? null;
            $chat = Chat::where(['employer_id' => $id])->get();
            $employer = User::find($id);

        }


        return view('Chat.chat', ['employerdata' => employerData(), 'employer_id' => $data, 'employer' => $employer]);

    }


    public function employeeProfile($id)
    {
        if ($id) {
            $employee = User::find($id);
            $data = Employee::where('employee_id', '=', $id)->first();
            $employeeSkills = [];

            foreach ($data->getProfileSkills as $key => $val) {

                $employeeSkills[] = $val->getSkillName->skills;
            }

            $employerdata = employerData();
            return view('Chat.chatEmployeeProfile', compact('employee', 'data', 'employeeSkills', 'employerdata'));
        }
    }


    public function employerProfile($employer_id)
    {
        if ($employer_id) {
            $data = Employer::where('employer_id', '=', $employer_id)->first();
            $employer = User::find($employer_id);
            $employerdata = employerData();
            return view('Chat.chatEmployerProfile', compact('employer', 'data', 'employerdata'));
        }
    }


    public function chat(Request $request, $id)
    {
        if ($request->routeIs('chat.employee.message')) {
            $data = [];
            $chats = Chat::where(['employee_id' => $id, 'employer_id' => Auth::id()])->get();
            foreach ($chats as $chat) {

                $data[date('Y-m-d', strtotime($chat->created_at))][] = $chat;
            }
            $employee = User::find($id);
            $html = view('Chat.employee_chat', ['chats' => $data])->render();
            $employee_html = view('Chat.employee_details', ['employee' => $employee])->render();

            return response()->json(['is_success' => true, 'html' => $html, 'employee_html' => $employee_html]);
        }
        if ($request->routeIs('chat.employer.message')) {
            $data = [];
            $chats = Chat::where(['employer_id' => $id, 'employee_id' => Auth::id()])->get();
            foreach ($chats as $chat) {

                $data[date('Y-m-d', strtotime($chat->created_at))][] = $chat;
            }
            $employer = User::find($id);

            $html = view('Chat.employer_chat', ['chats' => $data])->render();
            $employer_html = view('Chat.employer_details', ['employer' => $employer])->render();

            return response()->json(['is_success' => true, 'html' => $html, 'employer_html' => $employer_html]);
        }



    }

    public function message(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id);
        $role = 2;
        $employee_id = null;
        $employer_id = null;
        if ($user->role == 1) {
            $role = 1;
            $employee_id = $id;
        } else {
            $role = 2;
            $employer_id = $id;
        }
        Chat::create([
            'role' => $role,
            'msg' => $request->message,
            'employer_id' => $employer_id ?? $request->reciever_id,
            'employee_id' => $employee_id ?? $request->reciever_id,
            'origin' => $id
        ]);
        // $html = view('Chat.employee_chat', ['chats' => $chat])->render();
        return response()->json(['is_success' => true]);


    }

    public function job($employer_id)
    {
        if ($employer_id) {
            $jobs = Job::where('employer_id', '=', $employer_id)->get();

            return view('Chat.employerJobs', ['jobs' => $jobs, 'employerdata' => employerData()]);
        }
    }


    public function search(Request $request)
    {
        if ($request->key) {
            $id = Auth::id();
            $jobs = Job::where(['employer_id' => $id,])->get();

            $data = [];

            foreach ($jobs as $val) {
                foreach ($val->inquery as $value) {
                    if ($value->employee_id) {
                        $data[] = $value->employee_id;
                    }
                }
            }

            $data = array_unique($data);
            $user = [];
            foreach ($data as $employee_id) {
                $user[] = User::where('id', '=', $employee_id)
                    ->where('name', 'LIKE', '%' . $request->key . '%')
                    ->get(['name', 'id' ,'image']);
            }
            return response()->json(['is_sucess' => true, 'user' => $user]);

        }
    }
}

