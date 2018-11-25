<?php
use Illuminate\Http\Request;
use App\Email;
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
    return view('email-add');
});

$router->post('/emails/add/{emails}', function (Request $request){
    $emails = $request->input('emails');
    $emails = preg_split('/ /',$emails); 
    sort($emails); 
    for($i = 0; $i < count($emails); $i++) {

        if(filter_var($emails[$i], FILTER_VALIDATE_EMAIL))
        {
        file_put_contents("emails.txt", $emails[$i], FILE_APPEND); // Coloca o email no arquivo emails.txt na pasta public
        $agora = new DateTime();
        $data = $agora->format('l-d-M-Y-H-i-s'); 

        file_put_contents("emails_$data.txt", $emails[$i]); // Cria um novo arquivo de acordo com o timestamps
        echo nl2br("  Email: $emails[$i] inserido com sucesso \n ");
        
        }
        else
        {
            echo nl2br( "Por favor insira um email valido \n");
        }
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