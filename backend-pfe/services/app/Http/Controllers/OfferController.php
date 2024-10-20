<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Notifications\OfferStarted;
use App\Models\Utilisateur;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::with('client')->where('status', 'open')->get();
        return response()->json($offers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'client_id' => 'required|integer',
            'budget' => 'required|integer',
            'status' => 'required|string'
        ]);

        try {
            $offer = Offer::create($request->all());
            return response()->json($offer, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create offer', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $offer = Offer::with('client')->findOrFail($id);
            return response()->json($offer);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Offer not found', 'message' => $e->getMessage()], 404);
        }
    }

    public function startOffer($id)
    {
        $offer = Offer::findOrFail($id);
        $developer = Auth::user();

        // Update offer status or perform other necessary actions here

        // Create a notification
        Notification::create([
            'user_id' => $offer->client_id,
            'message' => "The developer has started your offer for {$offer->title}",
            'type' => 'info',
            'developer_id' => $developer->id, // Store developer id for fetching details later
        ]);

        return response()->json(['message' => 'Offer started and notification sent']);
    }
}
