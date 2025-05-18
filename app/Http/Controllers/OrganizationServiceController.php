<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\Service;
class OrganizationServiceController extends Controller
{


    public function getProviders(Request $request, $name)
    {
        $service = Service::where('name', $name)->firstOrFail();

        // Start with base query
        $query = Organization::whereHas('services', function ($query) use ($service) {
            $query->where('services.id', $service->id);
        })
        ->with(['services' => function ($query) use ($service) {
            $query->where('services.id', $service->id)->withPivot('price');
        }]);

        // Filter by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by rating
        if ($request->filled('min_rating')) {
            $minRating = (float) $request->min_rating;
            $orgIds = \App\Models\Review::selectRaw('organization_id, AVG(rating) as avg_rating')
                ->where('service_id', $service->id)
                ->groupBy('organization_id')
                ->having('avg_rating', '>=', $minRating)
                ->pluck('organization_id');

            $query->whereIn('id', $orgIds);
        }

        // Filter by price using whereHas on pivot table
        if ($request->filled('min_price') || $request->filled('max_price')) {
            $query->whereHas('services', function ($q) use ($service, $request) {
                $q->where('services.id', $service->id);

                if ($request->filled('min_price')) {
                    $q->where('organization_service.price', '>=', $request->min_price);
                }
                if ($request->filled('max_price')) {
                    $q->where('organization_service.price', '<=', $request->max_price);
                }
            });
        }

        // Pagination
        $organizations = $query->paginate(6);

        // Attach average rating for display
        foreach ($organizations as $organization) {
            $organization->average_rating = \App\Models\Review::where('service_id', $service->id)
                ->where('organization_id', $organization->id)
                ->avg('rating');

            $totalEmployees = $organization->employees()->count();
            $inactiveEmployees = $organization->employees()->where('status', 'inactive')->count();

            $organization->all_employees_inactive = ($totalEmployees > 0 && $inactiveEmployees === $totalEmployees);
        }

        return view('user.providers', compact('service', 'organizations'));
    }




    public function showOrganizations()
{
    $organizations = Organization::all();
    return view('user.organizations', compact('organizations'));
}

public function showServices()
{
    $services = Service::all();
    return view('user.services', compact('services'));
}

public function showprov(){
    $services = Service::all();
    return view('user.providers', compact('services'));
}

}



