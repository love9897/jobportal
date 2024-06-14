<?php

namespace App\Http\Controllers;


use App\Models\City;
use App\Models\Country;
use App\Models\Employer;
use App\Models\Experience;
use App\Models\Language;
use App\Models\Salary;
use App\Models\Skill;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Session;

class EmployerController extends Controller
{

    public function welcome()
    {
        return view('mail.welcome');
    }

    public function profile()
    {
        $id = Auth::id();
        $data = User::with('profile')->find($id);
        // dd($data->profile->employer_id);
        return view('employer.profile', ['employer' => $data, 'employerdata' => employerData()]);
    }
    public function profileEdit()
    {
        $id = Auth::id();
        $data = User::with('profile')->find($id);
        $cities = City::all()->take(200);
        $states = State::all();
        $country = Country::all();
        // return view('employer.profile_edit', ['data' => $data]);
        return view('employer.profile_edit', ['data' => $data, 'employerdata' => employerData(), 'cities' => $cities, 'country' => $country, 'states' => $states]);
    }

    public function edit(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'company' => 'required',
            'phone' => 'required|numeric|digits:10',
            'address' => 'required',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);

        $id = Auth::id();
        // dd($id);

        $employer = Employer::where(['employer_id' => $id])->first();
        // dd($employer);
        if ($employer) {


            $employer->company_name = $request->company;
            $employer->company_phone = $request->phone;
            $employer->location = $request->address;
            $employer->long = $request->longitude;
            $employer->lat = $request->latitude;
            $employer->state_id = $request->state_id;
            $employer->city_id = $request->city_id;
            $employer->country_id = $request->country_id;

        }

        $result = $employer->save();

        if ($result) {
            $request->session()->flash('success', 'Your Profile is Completed');
        } else {
            $request->session()->flash('error', 'Something Went Wrong !');
        }


        return redirect()->back();
    }

    public function add()
    {
        $id = Auth::id();

        $skills = Skill::all();
        $languages = Language::all();
        $experience = Experience::all();
        $salary = Salary::all();

        return view('employer.add_job', ['skills' => $skills, 'employerdata' => employerData(), 'languages' => $languages, 'experience' => $experience, 'salary' => $salary]);
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function message()
    {
        return view('Chat.chat', ['employerdata' => employerData(),]);
    }
}
