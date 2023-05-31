<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = new Message();
        if (request()->get("mesaj")) {
            $messages = $messages->where("name", "LIKE", "%" . request()->get("mesaj") . "%");
        }
        $messages = $messages->orderBy("created_at", "DESC")->paginate(10)->withQueryString();
        return view("back.notification-management.messages", compact("messages"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {
        Message::create($request->post());
        return back()->withSuccess("Mesaj başarıyla gönderildi");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Message::find($id)->delete();
        return back();
    }
}
