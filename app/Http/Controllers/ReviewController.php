<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
// use App\Providers\SweetAlertServiceProvider;
use Redirect;
use SweetAlert;
use Alert;
use Illuminate\Support\Facades\Validator;

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
        $count_Reviews = Review::count();
        $oneStarReviews = Review::where("review", 1)->count();
        $twoStarReviews = Review::where("review", 2)->count();
        $threeStarReviews = Review::where("review", 3)->count();
        $fourStarReviews = Review::where("review", 4)->count();
        $fiveStarReviews = Review::where("review", 5)->count();
        // dd($count_Reviews);
        return view('frontend.rateus', compact('twoStarReviews','threeStarReviews','count_Reviews', 'oneStarReviews', 'fourStarReviews','fiveStarReviews'));

        // dd(authCustomer()->id);

    }

    public function submit_rating(Request $request){


        $validator = Validator::make($request->all(), [
            'review' => 'required',
            'comment' => 'required'
        ]);
        if($validator->fails()){

            alert()->message('Please fill all fields');
            return redirect()->back();

        }
        else{
            $review = new Review();

            $review->review = $request->review;
            $review->comment = $request->comment;

            $review->save();

            // SweetAlert::message('Successfully submitted review');
            // alert()->warning('WarningAlert','Lorem ipsum dolor sit amet.');
            alert()->message('Thank you for your Review, Have a wonderful day.');

            return redirect()->route('home');
        }
    }


    public function updateStatus(Request $request){

        $review = Review::findOrFail($request->review_id);
        $review->status = $request->status;
        $review->save();

        return response()->json(['message' => 'Review status updated successfully.']);
    }

    public function reviews_page(){

        $reviews = Review::where('status', '1')->orderBy('created_at', 'DESC')->paginate(10);
        return view('frontend.review', compact('reviews'));

    }
}
