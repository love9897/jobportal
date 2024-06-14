<label><b>Profile</b></label>
<p>{{ $data->job_title }}</p>
<label><b>Description</b></label>
<p>{{ $data->job_description }}</p>
<label><b>Experience</b></label>
<p>{{ $data->getExperience->experience }}</p>
<label><b>Comapany</b></label>
<p>{{ $data->getEmployer->company_name }}</p>
<label><b>Skills</b></label>
@foreach ($data->getSkill as $val)
    <p>{{ $val->getSkillName->skills }}</p>
@endforeach
<label><b>Salary</b></label>
<p>{{ $data->getSalary->salary }}</p>
