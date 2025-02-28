<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colleges = College::all();
        return view('colleges.index', compact('colleges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('colleges.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:colleges,name',
            'address' => 'required|string|max:255',
        ]);

        College::create($request->all());

        return redirect()->route('colleges.index')->with('success', 'College added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $college = College::with('students')->findOrFail($id);
        return view('colleges.show', compact('college'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $college = College::findOrFail($id);
        return view('colleges.edit', compact('college'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:colleges,name,' . $id,
            'address' => 'required|string|max:255',
        ]);

        $college = College::findOrFail($id);
        $college->update($request->all());

        return redirect()->route('colleges.index')->with('success', 'College updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $college = College::findOrFail($id);
        $college->delete();

        return redirect()->route('colleges.index')->with('success', 'College deleted successfully.');
    }
}
