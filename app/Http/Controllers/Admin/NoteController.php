<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    public function create(Type $var = null)
    {
        # code...
    }

    public function store(Request $request)
    {
        $rules = [
            'product_id' => 'required',
			'note' => 'required',
		];

        $data = $request->validate($rules);

        $data['user_id'] = auth()->user()->id;

        $note = Note::create($data);

        // return route('admin.products.show', $data['product_id']);
        return redirect()
            ->route('admin.products.show', $data['product_id']);

        // return redirect()->back();
    }

    public function edit(Type $var = null)
    {
        # code...
    }

    public function update(Request $request, Note $note)
    {
        if ($note->user_id != auth()->user()->id) {
            redirect()->back()->withErrors('Не маєте права на редагування цієї нотатки');

        }else{
            $rules = [
                'note' => 'required',
            ];

            $messages = [
                'note.required' => 'Fill note text',
            ];


            $data = $request->validate($rules, $messages);

            $saved = $note->update($data);
            // flash('Poznámka byla úspěšně upravena')->success();
        }



        return redirect()->route('admin.products.show', $note->product->id);
    }

    public function delete(Note $note)
    {
        if ($note->user->id != auth()->user()->id) {
            redirect()->back()->withErrors('Не маєте право на видалення цієї нотатки');
        }else{
            $note->delete();
            redirect()->back()->withSuccess('Успішно видалено');
            // flash('Poznámka byla úspěšně smazána ')->success();
        }



        return redirect()->route('admin.products.show', $note->product->id);
    }
}
