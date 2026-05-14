<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = $request->user();
        abort_unless($user && $user->role === 'admin', 403);

        $toursCount = Tour::count();
        $bookingsCount = Booking::count();
        $paidBookingsCount = Booking::where('status', 'paid')->count();

        $latestBookings = Booking::with('tour')
            ->latest('id')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'toursCount',
            'bookingsCount',
            'paidBookingsCount',
            'latestBookings'
        ));
    }
}

