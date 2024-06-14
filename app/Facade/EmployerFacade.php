<?php
namespace App\Facade;

use Illuminate\Support\Facades\Facade;

class EmployerFacade extends Facade
{
    public function test()
    {
        echo "hello facade";
    }
    protected static function getFacadeAccessor()
    {

    }
}


?>