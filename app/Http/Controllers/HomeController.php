<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Job_inquiries;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

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
    // public function index()
    // {

    //     return view('home');
    // }



    public function dashboard()
    {
        $id = Auth::id();
        $data = User::find($id);
        $jobs = Job::where(['employer_id' => $id])->get();
        if ($data->role == 1) {
            $applied_jobs = Job_inquiries::where(['employee_id' => $id])->get();

            return view('employee.employeeDashboard',compact('applied_jobs'), ['employerdata' => $data  ]);
        } else {
            return view('employer.employerDashboad', ['employerdata' => $data, 'jobs_list' => $jobs]);
        }
    }
}
