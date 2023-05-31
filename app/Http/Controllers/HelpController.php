<?php

namespace App\Http\Controllers;

use App\Http\Requests\HelpRequest;
use App\Models\Help;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $helpQuestions = new Help;
        if (request()->get("yardim")) {
            $helpQuestions = $helpQuestions->where("title", "LIKE", "%" . request()->get("yardim") . "%");
        }
        $helpQuestions = $helpQuestions->orderBy("created_at", "desc")->paginate(10);
        return view("back.page-management.help", compact("helpQuestions"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HelpRequest $request)
    {
        Help::create($request->post());
        return back()->withSuccess("Yardım sorusu başarıyla kaydedildi!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $help = Help::where("slug", $slug)->first();
        return view("back.page-management.help-edit", compact("help"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HelpRequest $request, $id)
    {
        Help::find($id)->update($request->post());
        $help = Help::find($id);
        return redirect()->route("help.edit", $help->slug)->withSuccess("Yardım sorusu başarıyla kaydedildi!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Help::find($id)->delete();
        return back();
    }
}
