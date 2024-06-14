<?php

use App\Models\Employee;
use App\Models\Job_inquiries;
use App\Models\User;

function employerData()
{
    $id = Auth::id();
    $data = User::find($id);

    return $data;
}

function role()
{
    $id = Auth::id();

    $user = User::find($id);

    if ($user) {
        if ($user->role == 2) {
            return false;
        } else {
            return true;
        }
    }

}

function getResume()
{

    $id = Auth::id();

    if ($id) {

        $user = User::find($id);
        if ($user->role == 1) {
            $employeeProfile = Employee::where(['employee_id' => $id])->first();
            $resume = $employeeProfile->resume;
            return $resume;
        }
    }

    return false;
}
function isApplied($job_id = null)
{
    $employee_id = Auth::id() ?? null;

    if ($employee_id && $job_id) {

        $is_applied = Job_inquiries::Where(['job_id' => $job_id, 'employee_id' => $employee_id])->count();

        if ($is_applied > 0) {
            return true;
        }
    }
    return false;
}



?>