<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Employee;
use App\Models\Experience;
use App\Models\Job;
use App\Models\Job_inquiries;
use App\Models\Job_skill;
use App\Models\Skill;
use App\Models\State;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Validator;

class EmployeeController extends Controller
{

    public function profile()
    {
        $id = Auth::id();
        $data = User::find($id);
        // dd($data->profile->employer_id);
        $profile = Employee::where(['employee_id' => $id])->first();
        $employeeSkills = [];

        foreach ($profile->getProfileSkills as $key => $val) {

            $employeeSkills[] = $val->getSkillName->skills;
        }

        return view('employee.profile', ['employee' => $data, 'data' => $profile, 'employeeSkills' => $employeeSkills, 'employerdata' => employerData()]);
    }
    public function profileEdit()
    {
        $id = Auth::id();
        $data = User::find($id);
        $profile = Employee::where(['employee_id' => $id])->first();

        $cities = City::all()->take(200);
        $states = State::all();
        $skills = Skill::all();
        $country = Country::all();
        $experience = Experience::all();
        return view('employee.profile_edit', ['data' => $data, 'experience' => $experience, 'profile' => $profile, 'employerdata' => employerData(), 'city' => $cities, 'country' => $country, 'skills' => $skills, 'state' => $states]);

    }

    public function edit(Request $request)
    {

        // dd($request->all());
        $rules = [
            'name' => 'required',
            'phone' => 'required|numeric|digits:10',
            'gender' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'skills' => 'required',
            'experience_id' => 'required',
            'github' => 'required',
            'resume' => 'required',

        ];

        $message = [
            'city_id.required' => ' City is required. ',
            'state_id.required' => ' State is required. ',
            'country_id.required' => ' Country is required. ',
            'experience_id.required' => ' Experience is required. ',
            'resume.required' => ' Upload Your CV',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id = Auth::id();
        $employee = Employee::where(['employee_id' => $id])->first();
        $user = User::find($id);

        $ext = $request->resume->extension();
        $unique_name = time() . '.' . $ext;

        if ($employee) {
            $employee->address = $request->address;
            $employee->gender = $request->gender;
            $employee->dob = $request->dob;
            $employee->city_id = $request->city_id;
            $employee->state_id = $request->state_id;
            $employee->country_id = $request->country_id;
            $employee->experience_id = $request->experience_id;
            $employee->github = $request->github;
            $employee->resume = $unique_name;
            $employee->company_name = $request->company_name ?? '';
            $employee->position = $request->position ?? '';
            $employee->portfolio = $request->portfolio ?? '';

            $result = $employee->save();

            if ($result) {
                $request->resume->storeAs('public/upload/cv/' . $unique_name);
            }
        }

        if ($user) {
            $user->name = $request->name;
            $user->phone = $request->phone;
            $output = $user->save();
        }


        // check skills are present or not

        $is_present_skills = Job_skill::where('employee_id', $id)->get();

        if (count($is_present_skills) > 0 && $is_present_skills) {
            // first delete old skills

            foreach ($is_present_skills as $skill) {

                $skill->delete();

            }

            // then update with new one
            if ($request->skills) {

                foreach ($request->skills as $key => $val) {

                    Job_skill::create([
                        'skill_id' => $val,
                        'employee_id' => $id,
                    ]);
                }
            }

        } else {
            if ($request->skills) {

                foreach ($request->skills as $key => $val) {
                    Job_skill::create([
                        'skill_id' => $val,
                        'employee_id' => $id,
                    ]);
                }
            }
        }


        if ($result || $output) {
            $request->session()->flash('success', 'Your Profile is Up to Date');
        } else {
            $request->session()->flash('error', 'Something Went Wrong !');
        }

        return back();
    }


    public function review(Request $request)
    {
        $id = $request->job_id;

        $data = Job::find($id);
        $html = view('employee.review', compact('data'))->render();
        return response()->json(['is_success' => true, 'html' => $html]);
    }


    public function message()
    {
        return view('Chat.chat', ['employerdata' => employerData(),]);
    }
}
