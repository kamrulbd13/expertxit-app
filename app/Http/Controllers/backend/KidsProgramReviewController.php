<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\KidsProgramming;
use App\Models\KidsProgramReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KidsProgramReviewController extends Controller
{
    // Store review
    public function store(Request $request, $trainingId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        KidsProgramReview::updateOrCreate(
            ['kidsProgramme_id' => $trainingId, 'user_id' => Auth::id()],
            ['rating' => $request->rating, 'review' => $request->review]
        );

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

    // Edit review (User panel)
    public function edit($id)
    {
        $review = KidsProgramReview::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        $review = KidsProgramReview::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $review->update($request->only('rating', 'review'));

        return redirect()->route('user.reviews.index')->with('success', 'Review updated successfully!');
    }

    public function destroy($id)
    {
        $review = KidsProgramReview::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $review->delete();

        return redirect()->route('user.reviews.index')->with('success', 'Review deleted successfully!');
    }

    // Show all reviews for training (Public)
    public function showReviews($trainingId)
    {
        $training = KidsProgramming::with('reviews.user')->findOrFail($trainingId);

        return view('trainings.reviews', compact('training'));
    }
}
