<?php

namespace App\Http\Controllers;
use App\Http\Requests\Request;
use Symfony\Component\HttpFoundation\Response;

class EmailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public static function filter($emails)
    {
        return  str_split('/ /',$emails,-1);      
    }

    public static function sort($emails)
    {
       return sort($emails);
    }

    public function send()
    {
        require_once '/path/to/Faker/src/autoload.php';
        $faker = Faker\Factory::create();
        if($faker->boolean)
        {
                
        }
        else
        {

        }
    }
    //
}
