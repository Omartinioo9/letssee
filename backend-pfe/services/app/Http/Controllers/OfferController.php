<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Récupère toutes les offres avec les détails du client.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Charger les offres avec les détails du client
        $offres = Offer::with('client')->where('status', 'open')->get();
        return response()->json($offres);
    }

    /**
     * Enregistre une nouvelle offre.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Valider la requête
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'client_id' => 'required|integer',
            'budget' => 'required|integer',
            'status' => 'required|string'
        ]);

        // Créer une nouvelle offre
        try {
            $offer = Offer::create([
                'title' => $request->title,
                'description' => $request->description,
                'client_id' => $request->client_id,
                'budget' => $request->budget,
                'status' => $request->status,
            ]);

            return response()->json($offer, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create offer', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
{
    try {
        // Charger les détails de l'offre avec les détails du client associé
        $offer = Offer::with('client')->findOrFail($id);
        return response()->json($offer);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Offer not found', 'message' => $e->getMessage()], 404);
    }
}
}
