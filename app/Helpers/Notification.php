<?php
use App\Models\Job;
use App\Models\Employer;

function notification($count = false)
{
    $id = Auth::id();

    $employer = Employer::find($id);

    $jobs = $employer->jobs ?? null;
    $notification_count = 0;
    $notifications = [];


    if ($jobs) {
        foreach ($jobs as $job) {



            foreach ($job->inquery as $inquiry) {




                // print_r($notifications);die;
                if ($inquiry->is_read == 0) {

                    $notification_count = $notification_count + 1;
                    $notifications[] = $inquiry;

                }
            }

        }
    }

    if ($count) {

        return $notification_count;

    }

    return $notifications;

    // return ['notifications' => $notifications, 'count' => $notification_count];


}


?>