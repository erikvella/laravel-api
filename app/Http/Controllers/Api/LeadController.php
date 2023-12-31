<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Lead;
use App\Mail\NewContact;

class LeadController extends Controller
{
    public function store(Request $request){
        // ricevo i dati dal client
        $data = $request->all();

        // verifico la validità dei dati ricevuti
        $validator = Validator::make($data,
        [
           'name' => 'required|min:2|max:255',
           'email' => 'required|min:2|max:255',
           'message' => 'required|min:2',
        ],
        [
            'name.required' => 'Il nome è un campo obbligatorio',
            'name.min' => 'Il nome deve avere almeno :min caratteri',
            'name.max' => 'Il nome deve avere al massimo :max caratteri',
            'email.required' => 'La email è un campo obbligatorio',
            'email.min' => 'La email deve avere almeno :min caratteri',
            'email.max' => 'Il nome deve avere al massimo :max caratteri',
            'message.required' => 'Il messaggio è un campo obbligatorio',
            'message.min' => 'Il messaggio deve avere almeno :min caratteri',
        ]
    );

    // se i dati non sono validi restituisco success = false e i messaggi di errore
    if($validator->fails()){
        $success = false;
        $errors = $validator->errors();
        return response()->json(compact('success' , 'errors'));
    }
    // // se non ci sono errori:

    // // 1 salvo i dati nel DB
    $new_lead = new Lead();
    $new_lead->fill($data);
    $new_lead->save();
    // // 2 invio l'email

    Mail::to('info@boolfolio.com')->send(new NewContact($new_lead));
    // // 3 restituisco success = true
        $success = true;
        return response()->json(compact('success'));
    }
}
