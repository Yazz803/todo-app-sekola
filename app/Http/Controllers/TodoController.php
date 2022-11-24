<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.home', [
            'todos' => Todo::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|min:3|max:100',
            'date' => 'required',
            'description' => 'required|min:3',
        ]);

        $validateData['user_id'] = auth()->user()->id;
        $validateData['status'] = 0;

        Todo::create($validateData);
        Alert::toast('Berhasil Menambahkan Todo!', 'success');
        return redirect()->route('dashboard.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        return view('dashboard.edit', [
            'todo' => $todo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        Todo::find($todo->id)->update([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description
        ]);

        Alert::toast('Berhasil Menyelesaikan Todo!', 'success');
        return redirect()->route('dashboard.index');
    }
    
    public function updateStatus(Request $request, Todo $todo)
    {
        Todo::find($todo->id)->update([
            'date_done' => now(),
            'status' => 1
        ]);

        Alert::toast('Berhasil Menyelesaikan Todo!', 'success');
        return redirect()->route('dashboard.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        Todo::where('id', $todo->id)->delete();
        Alert::toast('Berhasil Menghapus Todo!', 'success');
        return redirect()->route('dashboard.index');
    }
}
