<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Middleware\Authenticate;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Salary;
use App\Models\State;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


Route::get('/', function () {

    $experience = Experience::all();
    $state = State::all();
    $skill = Skill::all();

    return view('welcome', ['experience' => $experience, 'state' => $state, 'skill' => $skill]);
});

Auth::routes();

Route::get('/home', [HomeController::class, 'dashboard'])->name('dashboad');
// Route::get('/employee/dashboard', [EmployeeController::class, 'EmployeeDashboard'])->name('role.Employee');

//employer / profile
Route::get('/profile', [EmployerController::class, 'profile'])->name('subject.profile');

Route::get('/profile/edit', [EmployerController::class, 'profileEdit'])->name('subject.profileEdit');

Route::get('/employee/profile', [EmployeeController::class, 'profile'])->name('employee.profile');

Route::get('/employee/profile/edit', [EmployeeController::class, 'profileEdit'])->name('employee.profileEdit');

Route::post('/employee/profile/store', [EmployeeController::class, 'edit'])->name('employee.store');

Route::post('/edit/store', [EmployerController::class, 'edit'])->name('subject.edit');
// add job
Route::get('/job/create', [EmployerController::class, 'add'])->name('subject.add');

// job route
Route::post('/job/created', [JobController::class, 'createJob'])->name('job.create');


Route::get('/logout', [EmployerController::class, 'logout'])->name('logout');

// welcome email template
Route::get('/welcome', [EmployerController::class, 'welcome'])->name('subject.welcome');

// search route
Route::get('/jobs', [JobController::class, 'jobs'])->name('subject.jobs');

Route::get('/jobs/search', [JobController::class, 'search'])->name('search.job');

// apply job
Route::post('/job/apply', [JobController::class, 'apply'])->name('apply.job');

// Route::post('/employee/job/apply', [JobController::class, 'employeeApply'])->name('employee.apply.job');

Route::get('job/inquery/{id?}', [JobController::class, 'inqueryDetails'])->name('inquer.details');

Route::get('/notification', [JobController::class, 'notification'])->name('inquery.notification');

Route::post('/review', [EmployeeController::class, 'review'])->name('application.review');

Route::get('/employee/message', [ChatController::class, 'employee_message'])->name('chat.employee');

Route::get('/employer/message', [ChatController::class, 'is_employee_apply'])->name('chat.employer');

Route::get('/employer/message/{employee_id?}', [ChatController::class, 'chat'])->name('chat.employee.message');

Route::get('/employee/message/{employer_id?}', [ChatController::class, 'chat'])->name('chat.employer.message');

Route::post('/search', [ChatController::class, 'search'])->name('chat.search');

Route::get('/chat/profile/{id?}', [ChatController::class, 'employeeProfile'])->name('chat.employee.profile');

Route::get('/chat/companyProfile/{employer_id?}', [ChatController::class, 'employerProfile'])->name('chat.employer.profile');

Route::post('/employer/message/', [ChatController::class, 'message'])->name('chat.employer.message');


Route::get('job/{employer_id}', [ChatController::class, 'job'])->name('chat.employer.jobs');













// email test
// Route::get('/test', function () {

//     $response = Mail::send('mail.welcome', ['name' => 'vikas'], function ($msg) {
//         $msg->to("j3rry9876@gmail.com")
//             ->subject("welcome email");
//     });
//     dd($response);
//     echo "jcc";
// });
