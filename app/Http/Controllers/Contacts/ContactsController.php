<?php

namespace App\Http\Controllers\Contacts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;

class ContactsController extends Controller
{
	public function index(Request $request){
        return view('contacts');

    }

    public function ask(Request $request){
		$input = $request->all();

		$rules = [
		    'name' => 'required|max:255',
		    'email' => 'required|email',
		    'subject' => 'max:255',
		    'message' => 'required|max:1024',
		];        
		$messages = [
		    'name.required' => 'Мы должны знать ваше имя!',
		    'email.required' => 'Для того, чтобы связаться с вами мы должны знать ваш почтовый адрес',
		    'email.email' => 'Укажите верный почтовый адрес',
		    'message.required' => 'Напишите что-нибудь!'
		];
		$validator = Validator::make($input, $rules, $messages);
		if ($validator->fails()) {
		    return redirect(URL::previous().'#contact-form')
		                ->withErrors($validator)
		                ->withInput();
		}
		else {
			if($request->ajax()) {
          		return 'Ваш вопрос успешно отправлен!';
        	}
        	else {
		    	return redirect(URL::previous().'#contact-form')->with('success','Ваш вопрос успешно отправлен!');
		    }
		}   	
    }
}
