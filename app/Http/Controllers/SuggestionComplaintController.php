<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuggestionComplaintRequest;
use App\Models\SuggestionComplaint;
use Illuminate\Http\Request;

class SuggestionComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suggestionsComplaints = new SuggestionComplaint;
        if (request()->get("oneri_sikayet")) {
            $suggestionsComplaints = $suggestionsComplaints->where("name", "LIKE", "%" . request()->get("oneri_sikayet") . "%");
        }
        $suggestionsComplaints = $suggestionsComplaints->orderBy("created_at", "DESC")->paginate(10)->withQueryString();
        return view("back.notification-management.suggestions-complaints", compact("suggestionsComplaints"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuggestionComplaintRequest $request)
    {
        $suggestionComplaint = SuggestionComplaint::create($request->post());
        return back()->withSuccess($suggestionComplaint->title == 'suggestion' ? 'Öneri başarıyla oluşturuldu!' : "Şikayet başarıyla oluşturuldu!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SuggestionComplaint::find($id)->delete();
        return back();
    }
}
