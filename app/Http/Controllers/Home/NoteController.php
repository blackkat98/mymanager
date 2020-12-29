<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteRequest;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteController extends HomeController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get();

        return view('home.notes.list', [
            'notes' => $notes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
    {
        $userId = Auth::user()->id;
        $content = htmlspecialchars($request->input('content'));
        $color = $request->input('color');
        $backgroundColor = $request->input('background-color');

        if (!$color || !$backgroundColor) {
            $style = '';
        } else {
            $style = "color: $color; background-color: $backgroundColor;";
        }

        if (!$style) {
            return [
                'status' => false,
                'message' => __('Invalid style'),
            ];
        }

        if (strtoupper($color) == strtoupper($backgroundColor)) {
            return [
                'status' => false,
                'message' => __('Color and background-color are the same'),
            ];
        }

        $commit = Note::create([
            'user_id' => $userId,
            'content' => $content,
            'style' => $style,
        ]);

        if ($commit) {
            return [
                'status' => true,
                'message' => __('Successfully created'),
                'data' => $commit,
            ];
        } else {
            return [
                'status' => false,
                'message' => __('Failed to create'),
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Note::find($id);

        if (!$note || $note->user_id != Auth::user()->id) {
            return [
                'status' => false,
            ];
        }

        return [
            'status' => true,
            'data' => $note,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoteRequest $request, $id)
    {
        $note = Note::find($id);

        if (!$note || $note->user_id != Auth::user()->id) {
            return [
                'status' => false,
            ];
        }

        $userId = Auth::user()->id;
        $content = htmlspecialchars($request->input('content'));
        $color = $request->input('color');
        $backgroundColor = $request->input('background-color');

        if (!$color || !$backgroundColor) {
            $style = '';
        } else {
            $style = "color: $color; background-color: $backgroundColor;";
        }

        if (!$style) {
            return [
                'status' => false,
                'message' => __('Invalid style'),
            ];
        }

        if (strtoupper($color) == strtoupper($backgroundColor)) {
            return [
                'status' => false,
                'message' => __('Color and background-color are the same'),
            ];
        }

        $commit = $note->update([
            'user_id' => $userId,
            'content' => $content,
            'style' => $style,
        ]);

        if ($commit) {
            return [
                'status' => true,
                'message' => __('Successfully updated'),
                'data' => $note,
            ];
        } else {
            return [
                'status' => false,
                'message' => __('Failed to update'),
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $note = Note::find($id);

        if (!$note || $note->user_id != Auth::user()->id) {
            return [
                'status' => false,
            ];
        }

        if ($note->delete()) {
            return [
                'status' => true,
                'message' => __('Successfully deleted'),
            ];
        } else {
            return [
                'status' => false,
                'message' => __('Failed to delete'),
            ];
        }
    }
}
