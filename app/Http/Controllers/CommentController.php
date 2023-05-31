<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\CommentAnswer;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::with("answers", "dead");
        if (request()->get("yorum")) {
            $comments = $comments->where("title", "LIKE", "%" . request()->get("yorum") . "%");
        }
        $comments = $comments->orderBy("created_at", "DESC")->paginate(10)->withQueryString();
        return view("back.notification-management.comments", compact("comments"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        Comment::create($request->post());
        return back()->withSuccess("Yorum başarıyla kaydedildi! Onay sürecinden sonra anasayfaya düşecektir.");
    }

    public function update(Request $request, $id)
    {
        Comment::find($id)->update([
            "status" => $request->status,
        ]);
        return back()->withSuccess("Yorum durumu başarıyla güncellendi!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comment::find($id)->delete();
        return back()->withSuccess("Yorum başarıyla silindi");
    }
}
