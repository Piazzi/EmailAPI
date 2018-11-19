<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return 'Email-API';
});

$router->post('/emails/add/{emails}', function (Request $emails){

   $emails->filter();
   $emails->sort();

    for($i = 0; $i < count($emails); $i++) {
        $this->validate($emails[$i], [
            'email' => 'required|email|max:50|min:5',
        ]);
        
        file_put_contents("emails.txt", $emails[$i], FILE_APPEND); // Coloca o email no arquivo.txt
        $data = new DateTime();
        file_put_contents("emails_{$data}.txt", $emails[$i], FILE_APPEND); // Cria um novo arquivo de acordo com o timestamps
    }
 
});

$router->post('/emails/send/', function($subject, $body){
    $emails_sent = 0;
    $emails_fail = 0;
    $emails = file("emails.txt", FILE_SKIP_EMPTY_LINES); // Pega os emails do txt
    for($i = 0; $i < count($emails); $i++) {
        $email = new Email($emails[$i]);
        if($email->send())
        $emails_sent++;
        else
        $emails_fail++;
    }

    return response()->json([
        'emails: ' => count($emails),
        'emails_sent: ' => $emails_sent ,
        'emails_fail: ' => $emails_fail ,
    ]);
});