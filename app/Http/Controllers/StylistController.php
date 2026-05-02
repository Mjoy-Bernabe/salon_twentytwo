<?php

namespace App\Http\Controllers;

use App\Models\Stylist;
use App\Models\StylistSchedule;
use Illuminate\Http\Request;

class StylistController extends Controller
{
    public function index()
    {
        $stylists = Stylist::all();
        return view('stylists.index', compact('stylists'));
    }

    public function create()
    {
        return view('stylists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        Stylist::create(['name' => $request->name]);

        return redirect()->route('stylists.index')->with('success', 'Stylist created successfully.');
    }

    public function edit(Stylist $stylist)
    {
        return view('stylists.edit', compact('stylist'));
    }

    public function update(Request $request, Stylist $stylist)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $stylist->update(['name' => $request->name]);

        return redirect()->route('stylists.index')->with('success', 'Stylist updated successfully.');
    }

    public function destroy(Stylist $stylist)
    {
        $stylist->delete();
        return redirect()->route('stylists.index')->with('success', 'Stylist deleted.');
    }

    public function show(Stylist $stylist)
    {
        return view('stylists.show', compact('stylist'));
    }

    public function schedule($id)
    {
        $stylist = Stylist::findOrFail($id);
        $schedules = $stylist->schedules;
        return view('stylists.schedule', compact('stylist', 'schedules'));
    }

    public function storeSchedule(Request $request, $id)
    {
        $request->validate([
            'day'        => 'required',
            'start_time' => 'required',
            'end_time'   => 'required',
        ]);

        $stylist = Stylist::findOrFail($id);

        $stylist->schedules()->create([
            'day'        => $request->day,
            'start_time' => $request->start_time,
            'end_time'   => $request->end_time,
        ]);

        return redirect()->back()->with('success', 'Schedule added.');
    }
}