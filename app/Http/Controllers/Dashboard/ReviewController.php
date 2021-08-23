<?php

namespace App\Http\Controllers\Dashboard;

use App\Review;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_reviews'])->only('index');
        $this->middleware(['permission:create_reviews'])->only('create');
        $this->middleware(['permission:update_reviews'])->only('edit');
        $this->middleware(['permission:delete_reviews'])->only('destroy');
    }
    public function index(Request $request)
    {
        $reviews = Review::all();

        // $reviews = Review::when($request->search, function ($q) use($request){

        //     return $q->where('title', 'like', '%' . $request->search . '%')->get();
        // })->latest()->get();

        return view('dashboard.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.reviews.index');
    }

    public function rateus()
    {
        // dd(authCustomer()->id);
        return view('frontend.rateus');
    }

    public function submit_rating(){



    }

    public function updateStatus(Request $request){

        $review = Review::findOrFail($request->review_id);
        $review->status = $request->status;
        $review->save();

        return response()->json(['message' => 'Review status updated successfully.']);
    }

    public function review_page(){

        $reviews = Review::Active();
        return view('frontend.review', compact('reviews'));

    }
}
