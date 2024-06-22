<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Calculator;
use App\Models\Employer;
use App\Models\Experience;
use App\Models\Job;

use App\Models\Job_inquiries;
use App\Models\job_language;
use App\Models\Job_skill;
use App\Models\Salary;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

use Notification;
use PhpParser\Node\Expr\BinaryOp\NotIdentical;
use PHPUnit\Framework\Constraint\IsEmpty;


class JobController extends Controller
{
    public function createJob(Request $request)
    {

        $request->validate([
            'job_title' => 'required',
            'skill' => 'required',
            'experience_id' => 'required',
            'language' => 'required',
            'salary_id' => 'required',
            'job_description' => 'required',
            'job_validity' => 'required|after_or_equal:today',
        ]);

        $request->request->add(['employer_id' => Auth::id()]); //add employer id here
        $arr = $request->all();
        $arr['job_validity'] = date('d-m-Y', strtotime($request->job_validity));


        $job = Job::create($arr);

        if ($job) {
            $id = $job->id;

            if ($request->skill) {
                foreach ($request->skill as $skill) {
                    Job_skill::create(['skill_id' => $skill, 'job_id' => $id]);
                }
            }
            if ($request->language) {
                foreach ($request->language as $language) {
                    job_language::create(['language_id' => $language, 'job_id' => $id]);
                }
            }
        }


        if ($job) {
            $request->session()->flash('success', 'Job posted Successfully');
        } else {
            $request->session()->flash('error', 'Something Went Wrong !');
        }


        return back();
    }

    public function jobs(Request $request)
    {

        $emp_data = Employer::with('getState')->get();
        $experience = Experience::all();
        $salary = Salary::all();
        $skill = Skill::all();

        $skill_id = $request->skill_id ?? null;
        $experience_id = $request->experience_id ?? null;
        $location_id = $request->location_id ?? null;
        $salary_id = $request->salary_id ?? null;
        $search = false;


        if ($skill_id && $experience_id) {
            $search = true;
        }

        $jobs = Job::paginate(5);

        return view('guest.guest_jobs', ['jobs' => $jobs, 'skill_id' => $skill_id, 'experience_id' => $experience_id, 'location_id' => $location_id, 'salary_id' => $salary_id, 'emp_data' => $emp_data, 'all_experience' => $experience, 'all_salary' => $salary, 'all_skills' => $skill]);
    }



    public function search(Request $request)
    {
        $emp_data = Employer::with('getState')->get();
        // dd($state);
        $experience = Experience::all();
        $salary = Salary::all();
        $skill = Skill::all();

        $skill_id = $request->skill_id ?? null;
        $experience_id = $request->experience_id ?? null;
        $location_id = $request->location_id ?? null;
        $salary_id = $request->salary_id ?? null;

        $jobs = Job::with(['getSkill', 'getExperience', 'getEmployer', 'getSalary']);



        $jobs = $jobs->where(function ($query) use ($skill_id, $experience_id, $location_id, $salary_id) {

            if ($skill_id) {


                $query->whereHas('getSkill', function ($query) use ($skill_id) {

                    if ($skill_id) {

                        $query->where('skill_id', $skill_id);
                    }
                });
            }

            if ($experience_id) {

                $query->whereHas('getExperience', function ($query) use ($experience_id) {

                    if ($experience_id) {
                        $query->where('id', $experience_id);
                    }
                });

            }

            if ($location_id) {
                $query->whereHas('getEmployer', function ($query) use ($location_id) {

                    if ($location_id) {
                        $query->where('state_id', $location_id);
                    }
                });

            }

            if ($salary_id) {

                if ($salary_id) {
                    $query->where('salary_id', $salary_id);
                }

            }

        })->paginate(5);

        return view('guest.guest_jobs', ['jobs' => $jobs, 'skill_id' => $skill_id, 'experience_id' => $experience_id, 'location_id' => $location_id, 'salary_id' => $salary_id, 'emp_data' => $emp_data, 'all_experience' => $experience, 'all_salary' => $salary, 'all_skills' => $skill]);
    }


    public function inqueryDetails(Request $request, $id)
    {
        // $idd = Auth::id();
        // $employer_data = User::find($idd);

        $data = Job_inquiries::where('job_id', '=', $id)->get();

        return view('employer.inquery', ['inquery_details' => $data, 'employerdata' => employerData()]);
    }

    public function notification()
    {


        // $latest_notification = Job_inquiries::orderBy('created_at', 'desc')->take(5)->get();
        $html = view('employer.notification_list', ['notification_list' => notification()])->render();
        if (!empty(notification())) {
            $data = notification();
            foreach ($data as $val) {
                Job_inquiries::where('job_id', '=', $val->job_id)->update(['is_read' => 1]);
            }
        }
        return response()->json(['is_success' => true, 'html' => $html]);

    }

    public function apply(Request $request)
    {
        $id = Auth::id();

        $result = Job_inquiries::create([
            'job_id' => $request->job_id,
            'employee_id' => $id,

        ]);
        $employee = User::find($id);
        $job = Job::find($request->job_id);
        $chat = Chat::create([
            'employer_id' => $job->employer_id,
            'employee_id' => $id,
            'msg' => $employee->name . ' applied for ' . $job->job_title . ' job',
            'origin' => $id
        ]);



        if ($result && $chat) {

            return response()->json([
                'is_success' => 'true',
                'msg' => 'Applied SuccessFully',
            ]);
        } else {
            return response()->json([
                'is_success' => 'false',
                'msg' => 'Something Went Wrong!',
            ]);
        }
    }

    public function employeeApply(Request $request)
    {
        $result = Job_inquiries::create([
            'job_id' => $request->job_id,
            'employee_id' => $request->employee_id,
        ]);
    }
}
