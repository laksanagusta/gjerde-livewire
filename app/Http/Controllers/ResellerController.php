<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResellerRequest;
use App\Http\Services\ResellerService;
use App\Models\Location;
use App\Models\Reseller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ResellerController extends Controller
{
    public function index(): View
    {
        return view('resellers.index', [
            'resellers' => Reseller::paginate(10)
        ]);
    }


    public function create(): View
    {
        $locations = Location::all();
        return view('resellers.create',[
            'locations' => $locations
        ]);
    }

    public function store(ResellerRequest $request, ResellerService $resellerService)
    {
        $resellerService->create($request->all());
        return view('resellers.index', [
            'resellers' => Reseller::paginate(10)
        ]);
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id, ResellerService $resellerService)
    {
        $locations = Location::all();
        $reseller = $resellerService->findById($id);
        return view('resellers.edit', [
            'reseller' => $reseller,
            'locations' => $locations
        ]);
    }

    public function update(ResellerRequest $request, string $id, ResellerService $resellerService)
    {
        $resellerService->updateOrCreate($request->all());
        return view('resellers.index', [
            'resellers' => Reseller::paginate(10)
        ]);
    }

    public function destroy(string $id)
    {
           
    }
}
