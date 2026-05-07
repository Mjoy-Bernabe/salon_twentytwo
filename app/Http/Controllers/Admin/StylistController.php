<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Stylist;
use Illuminate\Http\Request;

class StylistController extends Controller
{
    public function index()
    {
        $stylists = Stylist::with('services', 'schedules')->paginate(10);
        return view('admin.stylists.index', compact('stylists'));
    }

    public function create()
    {
        $services = Service::all();
        return view('admin.stylists.create', compact('services'));    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'service_ids' => 'nullable|array',
            'service_ids.*' => 'exists:services,id',
        ]);

        $stylist = Stylist::create(['name' => $data['name']]);
        $stylist->services()->sync($data['service_ids'] ?? []);

        return redirect()->route('admin.stylists.index')->with('success', 'Stylist created successfully.');
    }

    public function edit(Stylist $stylist)
    {
        $services = Service::all();
        $selectedServices = $stylist->services()->pluck('services.id')->toArray();

        return view('admin.stylists.edit', compact('stylist', 'services', 'selectedServices'));
    }

    public function update(Request $request, Stylist $stylist)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'service_ids' => 'nullable|array',
            'service_ids.*' => 'exists:services,id',
        ]);

        $stylist->update(['name' => $data['name']]);
        $stylist->services()->sync($data['service_ids'] ?? []);

        return redirect()->route('admin.stylists.index')->with('success', 'Stylist updated successfully.');
    }

    public function destroy(Stylist $stylist)
    {
        $stylist->services()->detach();
        $stylist->delete();

        return redirect()->route('admin.stylists.index')->with('success', 'Stylist deleted.');
    }

    public function show(Stylist $stylist)
    {
        return view('admin.stylists.show', compact('stylist'));
    }

    public function schedule(int $id)
    {
        $stylist = Stylist::with('schedules')->findOrFail($id);
        return view('admin.stylists.schedule', compact('stylist'));
    }

    public function storeSchedule(Request $request, int $id)
    {
        $request->validate([
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $stylist = Stylist::findOrFail($id);
        $stylist->schedules()->create([
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->back()->with('success', 'Schedule added.');
    }
}
