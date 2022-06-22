<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewsController extends Controller
{
    private $teste2;

    public function setapproved($id)
    {

        $review = Review::findOrfail($id);

        $review->update([
            'approved' => 1,
        ]);

        return redirect('/reviews');
        
    }

    public function setdisapproved($id)
    {

        $review = Review::findOrfail($id);

        $review->update([
            'approved' => 0,
        ]);

        return redirect('/reviews');
        
    }

    public function index()
    {

        return view('reviews.main', [
            'reviews' => Review::select(
                    'reviews.*',
                    'places.name AS place_name',
                    'users.name AS user_name',

            )             
            ->join('places', 'places.id', '=', 'reviews.place_id')
            ->join('users', 'users.id', '=', 'reviews.user_id')
            ->get()
        ]);
        
    }



////////        API        //////////////////////////////

    public function store(Request $request)
    {

        Review::create([
        'user_id' => $request->user_id,
        'place_id' => $request->place_id,
        'comment' => $request->comment,
        'rating' => $request->rating,
        'approved' => 0,
        ]);

        return json_encode(array("response"=>"success"));

    }

    public function returnreviews()
    {

        echo Review::select(
                    'reviews.*',
                    'users.name AS user_name',

            )             
            ->join('users', 'users.id', '=', 'reviews.user_id')
            ->get();

    }

    public function returnreviewsplace(Request $request)
    {

        $this->teste2 = $request->place_id;
        
        echo Review::select(
                    'reviews.*',
                    'users.name AS user_name',

            )             
            ->join('users', 'users.id', '=', 'reviews.user_id')
            ->where('reviews.place_id', $request->place_id)
            ->where('reviews.user_id', $request->user_id)
            ->orWhere(function($query) {
                $query->where('reviews.approved','=',1)
                      ->where('reviews.place_id','=',$this->teste2);
            })->get();

    }

    public function update(Request $request)
    {

        $review = Review::findOrfail($request->id);

        $review->update([
            'comment' => $request->comment,
            'rating' => $request->rating,
            'approved' => 0,
        ]);

        return json_encode(array("response"=>"success"));

    }

    public function delete($id)
    {
        $review = Review::findOrfail($id);

        $review->delete();

        return json_encode(array("response"=>"success"));
    }


    public function check(Request $request)
    {

        $review = Review::select(
                    'reviews.*',
            )
            ->join('users', 'users.id', '=', 'reviews.user_id')
            ->where('reviews.place_id', $request->place_id)
            ->where('reviews.user_id', $request->user_id)
            ->count();

        if ($review > 0) {
            return json_encode(array("response"=>"success"));
        }else{
            return json_encode(array("response"=>"false"));
        }

    }

////////        API        //////////////////////////////

}
