<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Http\Services\LocationService;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LocationController extends Controller
{
    public function index(): View
    {
        return view('locations.index', [
            'locations' => Location::paginate(10)
        ]);
    }


    public function create(): View
    {
        return view('locations.create');
    }

    public function store(LocationRequest $request, LocationService $locationService)
    {
        $locationService->create($request->all());
        return view('locations.index', [
            'locations' => Location::paginate(10)
        ]);
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id, LocationService $locationService)
    {
        $location = $locationService->findById($id);
        return view('locations.edit', $location);
    }

    public function update(LocationRequest $request, string $id, LocationService $locationService)
    {
        $locationService->updateOrCreate($request->all());
        return view('locations.index', [
            'locations' => Location::paginate(10)
        ]);
    }

    public function destroy(string $id)
    {
        Location::destroy($id);
        return view('locations.index', [
            'locations' => Location::paginate(10)
        ]);
    }
}
