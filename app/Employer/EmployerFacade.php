<?php
namespace App\Employer;
use Illuminate\Support\Facades\Facade;

class EmployerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'employer';
    }
}

?>