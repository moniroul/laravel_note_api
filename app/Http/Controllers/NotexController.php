<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NotexController extends Controller
{
    // Retrieve all notes
    public function index()
    {
        $note = Note::all();

        return response()->json(['status' =>  true, "message" => "Success", "data" => $note], 200);
    }

    // Retrieve a single note
    public function show($id)
    {
        return Note::findOrFail($id);
    }

    // Create a new note
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'note' => 'required|string',
        ]);
 
        $note = Note::create($validatedData);

        return response()->json(['status' =>  true, "message" => "Success", "data" => $note], 201);
    }

    // Update an existing note
    public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);
        $note->update($request->all());

        return response()->json($note, 200);
    }

    // Delete a note
    public function destroy($id)
    {
        Note::destroy($id);

        return response()->json(null, 204);
    }
}
