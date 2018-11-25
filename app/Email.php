<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
require_once '/path/to/Faker/src/autoload.php';

class Email extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $filliable = ['email'];

    public function __construct($email)
    {

    }

    public static function filter($emails)
    {
        return  str_split('/ /',$emails,-1);      
    }

    public static function sort($emails)
    {
       return sort($emails);
    }

    public function send($subject, $body)
    {
        require_once '/path/to/Faker/src/autoload.php';
        $faker = Faker\Factory::create();
        if($faker->boolean)
        {
            $logger = new Logger('sent');
            $logger->pushHandler(new StreamHandler(DIR. '/sent.log', Logger::DEBUG));
            $data = new DateTime();
            $logger->info('Hora:'. $data . 'Endereço: '.$email.'Assunto: '.$subject);                  
        }
        else
        {
            $logger = new Logger('fail');
            $logger->pushHandler(new StreamHandler(DIR. '/fail.log', Logger::DEBUG));
            $logger->info('Hora:'. $data . 'Endereço: '.$email.'Assunto: '.$subject);                  
        }
    }
    //
}
