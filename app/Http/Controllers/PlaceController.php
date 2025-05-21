<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showForm()
    {
        $prices = Place::select('type', 'cost')
            ->whereIn('type', ['work', 'tell'])
            ->get()
            ->pluck('cost', 'type')
            ->toArray();

        $prices = array_merge([
            'work' => 0.00,
            'tell' => 0.00,
        ], $prices);

        return view('home', compact('prices')); // Render home.blade.php
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'data' => 'required|date',
            'type' => 'required|in:work,tell',
            'places' => 'required_if:type,tell|integer|min:1|max:12',
        ]);

        $place = Place::where('type', $request->type)->firstOrFail();
        $totalPrice = $request->type === 'tell'
            ? $place->cost + ($request->places * 10) // $10 per person surcharge
            : $place->cost;

        // Save order or process further (e.g., save to orders table)
        return redirect()->back()->with('success', "Order submitted! Total price: $$totalPrice");
    }



    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorePlaceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlaceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlaceRequest  $request
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlaceRequest $request, Place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        //
    }
}
