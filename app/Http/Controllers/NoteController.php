<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

    public function index()
    {
        $notes = Note::all()->where('user_id', Auth::id());
        return view('dashboard', ['notes'=>$notes]);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        Note::create($data);
        return redirect()->back();//це функція в Laravel, яка виконує перенаправлення користувача
                                 // на попередню сторінку, з якої був зроблений запит.
    }

    public function update(Request $request, $id)
    {
        $note = Note::query()->findOrFail($id);
        $note->update($request->all());
        return redirect()->back();
    }

    public function destroy($id)
    {
        $note = Note::query()->findOrFail($id);
        $note->delete();
        return redirect()->back();
    }


}
