<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotexController extends Controller
{
    // Retrieve all notes
    public function index()
    {
        $notes = Note::latest()->paginate(10);
        return response()->json($notes);
    }


    // Retrieve a single note
    public function show($id)
    {

        try {
            return Note::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 422);
        }
    }



    // search note
    public function queryNote(Request $request)
    {

        $query = $request->query('query');
        if (empty($query)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Query parameter is required',
            ], 422);
        } else {
            $notes = Note::where('title', 'LIKE', "%{$query}%")
                ->orWhere('note', 'LIKE', "%{$query}%")
                ->latest()
                ->paginate(10);

            return response()->json($notes);
        }
    }


    // Create a new note
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'note' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }
            $note = Note::create($request->all());

            return response()->json($note, 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 422);
        }
    }




    // Update an existing note
    public function update(Request $request, $id)
    {

        try {

            $note = Note::findOrFail($id);

            if (empty($note)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Note not found',
                ], 422);
            }
            $note->update($request->all());
            return response()->json($note, 200);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 422);
        }
    }


    // Delete a note
    public function destroy($id)
    {
        try {

            $res =  Note::destroy($id);
            if ($res == 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Note not found',
                ], 422);
            } else {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Note deleted successfully',
                ], 200);
            }
        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
