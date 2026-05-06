<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Stylist;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'all');
        $servicesQuery = Service::with(['stylists', 'components']);

        if ($tab === 'promo') {
            $servicesQuery->where('is_promo', true);
        } elseif ($tab === 'service') {
            $servicesQuery->where('is_promo', false);
        }

        $services = $servicesQuery->paginate(10)->withQueryString();
        $serviceNames = Service::orderBy('service_name')->pluck('service_name');

        return view('admin.services.index', compact('services', 'serviceNames', 'tab'));
    }

    public function create(Request $request)
    {
        $stylists = Stylist::all();
        $baseServices = Service::where('is_promo', false)->orderBy('service_name')->get();
        $isPromoTab = $request->query('tab') === 'promo';

        return view('admin.services.create', compact('stylists', 'baseServices', 'isPromoTab'));
    }

    public function store(Request $request)
    {
        $isPromo = $request->boolean('is_promo');

        $data = $request->validate([
            'service_name' => 'required|string|max:100',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'is_promo' => 'nullable|boolean',
            'stylist_ids' => 'nullable|array',
            'stylist_ids.*' => 'exists:stylists,id',
            'component_service_ids' => $isPromo ? 'required|array|min:1' : 'nullable|array',
            'component_service_ids.*' => Rule::exists('services', 'id')->where('is_promo', false),
        ]);

        $service = Service::create([
            'service_name' => $data['service_name'],
            'price' => $data['price'],
            'description' => $data['description'] ?? null,
            'is_promo' => $request->boolean('is_promo'),
        ]);

        $service->stylists()->sync($data['stylist_ids'] ?? []);
        $service->components()->sync($service->is_promo ? $data['component_service_ids'] ?? [] : []);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $stylists = Stylist::all();
        $baseServices = Service::where('is_promo', false)->orderBy('service_name')->get();
        $selectedStylists = $service->stylists()->pluck('id')->toArray();
        $selectedComponents = $service->components()->pluck('id')->toArray();

        return view('admin.services.edit', compact('service', 'stylists', 'selectedStylists', 'baseServices', 'selectedComponents'));
    }

    public function update(Request $request, Service $service)
    {
        $isPromo = $request->boolean('is_promo');

        $data = $request->validate([
            'service_name' => 'required|string|max:100',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'is_promo' => 'nullable|boolean',
            'stylist_ids' => 'nullable|array',
            'stylist_ids.*' => 'exists:stylists,id',
            'component_service_ids' => $isPromo ? 'required|array|min:1' : 'nullable|array',
            'component_service_ids.*' => Rule::exists('services', 'id')->where('is_promo', false),
        ]);

        $service->update([
            'service_name' => $data['service_name'],
            'price' => $data['price'],
            'description' => $data['description'] ?? null,
            'is_promo' => $request->boolean('is_promo'),
        ]);

        $service->stylists()->sync($data['stylist_ids'] ?? []);
        $service->components()->sync($service->is_promo ? $data['component_service_ids'] ?? [] : []);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->stylists()->detach();
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }

    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }
}
