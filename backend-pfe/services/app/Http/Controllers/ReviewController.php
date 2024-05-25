<?php

namespace App\Http\Controllers;

use App\Models\Review;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function getUserReviews($id)
    {
        $reviews = Review::where('user_id', $id)->get();
        return response()->json($reviews);
    }

}