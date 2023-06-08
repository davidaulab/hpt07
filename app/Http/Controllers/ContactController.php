<?php

namespace App\Http\Controllers;

use App\Mail\ContactNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RuntimeException;

class ContactController extends Controller
{
    //
    public function create () {

        return view ('contact');

    }

    public function store (Request $request) {
        $name= $request->name;
        $email= $request->email;
        $message = $request->message;
        $privacy = $request->privacy;

        try {
            Mail::to("david.martinez@aulab.es")->send(new ContactNotification($name, $email, $message));

        } catch (RuntimeException $e) {
            return back()->with ('message', 'No se ha podido enviar el correo')->with('code', 400);
        }
        
        return back()->with ('message', 'Correo enviado satisfactoriamente')->with('code', 0);

       // return view ('home') ;

    }
}
