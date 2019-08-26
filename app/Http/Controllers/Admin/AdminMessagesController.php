<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Support\Facades\DB;

class AdminMessagesController extends Controller
{
    //messages control panel (display all messages)
    
    public function messagesPanel(){
    
      $messages = Message::paginate(10);
      return view('admin.messagesPanel', ["messages" => $messages]);
    }

    public function deleteMessage(Request $request, $id){

      $deleted =  DB::table('messages')->where("id",$id)->delete();    
      if($deleted){ 
         return redirect()->back()->with('messageDeletionStatus', 'Сообщение было успешно удалено');   
      }else{

        return redirect()->back()->with('messageDeletionStatus', 'Сообщение не удалось удалить');   
      }

    }    
}
