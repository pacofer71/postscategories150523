<?php

namespace App\Http\Controllers\Mails;

use App\Http\Controllers\Controller;
use App\Mail\ContactoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function index(){
        return view('correosforms.contacto');
    }
    public function procesarFormContacto(Request $request){
        $request->validate([
            'nombre'=>['required', 'string', 'min:3'],
            'email'=>['required', 'email'],
            'contenido'=>['required', 'string', 'min:10'],
        ]);
        $email = auth()->user() ? auth()->user()->email : $request->email;
        try{
            Mail::to('adminsitio@email.com')->send(new ContactoMail($request->nombre, $email, $request->contenido));
        }catch(\Exception $ex){
            return redirect()->route('welcome.inicio')->with('info', 'No se pudo enviar el mensaje, inténtelo más tarde');
        }
        return redirect()->route('welcome.inicio')->with('info', 'Mensaje enviado');
        
    }
}
