<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use App\Models\Employer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric', 'digits:10'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'role' => ['required'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {


        if (isset($data['image']) || !empty($data['image'])) {
            $extension = $data['image']->extension();
            // dd($extension);
            $unique_name = time() . '.' . $extension;
            // dd($unique_name);
            $is_uploaded = $data['image']->storeAs('public/upload/user/', $unique_name);
        }
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role' => $data['role'],
            'image' => $unique_name,
            'password' => Hash::make($data['password']),

        ]);
        if ($user->role == 1) {
            $employee = new Employee();
            $employee->employee_id = $user->id;
            $employee->save();
        } else {
            $employer = new Employer();
            $employer->employer_id = $user->id;
            $employer->save();
        }
        // if (isset($data['email']) && !empty($data['email'])) {

        //     $email = $data['email'];
        //     $email_data = ['name' => $data['name'], 'email' => $data['email']];

        // Mail::send('mail.welcome', $email_data, function ($msg) use($email){
        //     $msg->to($email)
        //         ->subject("welcome email");
        // });
        // }

        return $user;
    }
}
