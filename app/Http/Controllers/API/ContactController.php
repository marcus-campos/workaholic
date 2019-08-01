<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ContactRequest;
use App\Http\Requests\API\ContactApiLeadRequest;

class ContactController extends Controller
{
    public function slackNotification(ContactRequest $request)
    {
        $data = $request;

        $message = "Olá!".PHP_EOL;
        $message .="Alguém acabou de entrar em contato pelo nosso site. Segue as informações do contato".PHP_EOL;
        $message .= " :speaking_head_in_silhouette: Nome: ".$data->name.PHP_EOL;
        $message .= " :email: Email: ".$data->email.PHP_EOL;
        $message .= " :phone: Telefone: ".$data->phone.PHP_EOL;
        $message .= " :abc: Assunto: ".$data->subject.PHP_EOL;
        $message .= " :book: Descrição: ".$data->description.PHP_EOL;

        try {
            \Slack::to('#contato')->send($message);
        } catch(\Exception $ex) {
            return ['error' => 'Slack communication fail'];
        }

        return ['status' => 200, 'msg' => 'Ok'];
    }

    public function lead(ContactApiLeadRequest $request)
    {
        $data = $request;

        $message = "Olá!".PHP_EOL;
        $message .="Capturamos um lead".PHP_EOL;
        $message .= " :email: Email: ".$data->email.PHP_EOL;

        try {
            \Slack::to('#captura-leads')->send($message);
        } catch(\Exception $ex) {
            return ['error' => 'Slack communication fail'];
        }

        return ['status' => 200, 'msg' => 'Ok'];
    }
}
