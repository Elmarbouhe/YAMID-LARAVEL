<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashController extends Controller
{
    public function index(Request $request)
    {
        $shopName = $request->input('search');
        // Get latitude and longitude from URL parameters
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // Get shops near the user's location
        $shops = DB::table('shops')
            ->select('name', 'latitude', 'longitude')
            ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                cos( radians( latitude ) ) *
                cos( radians( longitude ) - radians(?) ) +
                sin( radians(?) ) *
                sin( radians( latitude ) ) ) ) AS distance', [$latitude, $longitude, $latitude])
            ->havingRaw('distance < ?', [50])
            ->orderBy('distance')
            ->when($shopName, function ($query, $shopName) {
                $query->where('name', 'like', "%{$shopName}%");
            })

            ->get();

        return view('/shop/Dashboard', compact('shops'));
    }
}
?>
