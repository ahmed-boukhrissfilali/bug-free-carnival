<?php

namespace App\Http\Controllers;

use App\Models\Persone;
use Illuminate\Http\Request;

class PersoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return Persone::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("CreatePersone");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => '',
            'email' => '',
            'phone' => 'required',
        ]);

        // return Persone::create($request->all());

         $personne = Persone::create($request->all());

         if($personne) {
            return response()->json(['message' => 'Personne created successfully'], 201);
         }
         else {
            return response()->json(['message' => 'Failed to create Personne'], 500);
         }
    }

    /**
     * Display the specified resource.
     */
    public function show($persone)
    {
        return Persone::find($persone);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persone $persone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:20',
    ]);

;

    $personne = Persone::find($id);
    $personne->update($request->all());

    if (!$personne) {
        return response()->json(['message' => 'Personne not found'], 404);
    }


    return response()->json(['message' => 'Personne updated successfully', 'data' => $personne], 200);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($persone)
    {
        $personne = Persone::find($persone);

        if (!$personne) {
            return response()->json(['message' => 'Personne not found'], 404);
        }

        $personne->delete();

        return response()->json(['message' => 'Personne deleted successfully'], 200);
    }
}
