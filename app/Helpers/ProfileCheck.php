<?php
use App\Models\Employee;
use App\Models\Employer;
use App\Models\User;


function profileCheck()
{
    $id = Auth::id();
    $employer = Employer::where('employer_id', '=', $id)->first();
    $employer_data = $employer ?? null;
    $profile_complete = 1;
    if ($employer_data) {
        $employer_data = $employer_data->toArray();

        foreach ($employer_data as $value) {

            if (!$value) {

                $profile_complete = 0;
            }
        }
    } else {
        $profile_complete = 0;
    }

    return $profile_complete;

}

function empProfileCheck()
{
    $id = Auth::id();
    $employee = Employee::where('employee_id', '=', $id)->first();
    $employee_data = $employee ?? null;
    $profile_complete = 1;
    if ($employee_data) {
        $employee_data = $employee_data->toArray();

        foreach ($employee_data as $value) {

            if (!$value) {

                $profile_complete = 0;
            }
        }
    } else {
        $profile_complete = 0;
    }

    return $profile_complete;

}
function getEmployeeSkills($employee_id = null)
{
    $id = null;
    if ($employee_id) {
        $id = $employee_id;
    } else {
        $id = Auth::id();
    }
    $skill_id = [];
    if ($id) {
        $data = User::find($id);
        $role = $data->role;
        if ($role == 1) {
            $data = Employee::where(['employee_id' => $id])->first();
            // dd($data->getProfileSkills);

            foreach ($data->getProfileSkills as $key => $val) {

                $skill_id[] = $val->skill_id;
            }
            return $skill_id;
        }
    }
    return false;
}


?>