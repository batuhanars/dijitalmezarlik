<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Models\Comment;
use App\Models\CommentAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $comment = Comment::find($id);
        $answers = $comment->answers();
        if (request()->get("cevap")) {
            $answers = $answers->where("title", "LIKE", "%" . request()->get("cevap") . "%");
        }
        $answers = $answers->orderBy("created_at", "DESC")->paginate(10)->withQueryString();
        return view("back.notification-management.comment_answers", compact("comment", "answers"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerRequest $request)
    {
        CommentAnswer::create($request->post());
        return back()->withSuccess("Yorum cevabı başarıyla kaydedildi! Onay sürecinden sonra anasayfaya düşecektir.");
    }

    public function update(Request $request, $id)
    {
        CommentAnswer::find($id)->update([
            "status" => $request->status,
        ]);
        return back()->withSuccess("Yorum cevap durumu başarıyla güncellendi!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CommentAnswer::find($id)->delete();
        return back()->withSuccess("Cevap başarıyla silindi!");
    }
}
