<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;
use App\Models\Place;
use App\Models\Gallery;

class PlacesController extends Controller
{
    public function index()
    {
        return view('places.main', [
            'places' => Place::select(
                    'places.*',
                    'cities.name AS city_name',
                    'states.name AS state_name',
            ) 
            ->join('cities', 'cities.id', '=', 'places.city_id')
            ->join('states', 'states.id', '=', 'places.state_id')
            ->get()
        ]);
    }

    public function fetchState()
    {
        return view('places.new', [
            'states' => State::all(),
        ]);
    }

    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function store(Request $request)
    {

        Place::create([
        'name' => $request->name,
        'description' => $request->description,
        'url_image' => $request->url_image,
        'services' => implode(', ', $request->services),
        'category' => $request->category,
        'place_fishes' => implode(', ', $request->place_fishes),
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'city_id' => $request->city_id,
        'state_id' => $request->state_id,
        'phone' => $request->phone,
        ]);

        return redirect('/places');

    }

    public function show($id)
    {

        return view('places.edit', [
            'places' => Place::select(
                    'places.*',
                    'cities.name AS city_name',
                    'states.name AS state_name',
            )
            ->join('cities', 'cities.id', '=', 'places.city_id')
            ->join('states', 'states.id', '=', 'places.state_id')
            ->where('places.id', $id)
            ->firstOrFail(),

            'galleries' => Gallery::select(
                    'galleries.*',
                    'places.name AS place_name',
            )
            ->join('places', 'places.id', '=', 'galleries.place_id')
            ->where('galleries.place_id', $id)
            ->get(),
           
            'states' => State::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $place = Place::findOrfail($id);

        if ($request->url_image == '') {
            $place->update([
            'name' => $request->name,
            'description' => $request->description,
            'services' => implode(', ', $request->services),
            'category' => $request->category,
            'place_fishes' => implode(', ', $request->place_fishes),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'city_id' => $request->city_id,
            'state_id' => $request->state_id,
            'phone' => $request->phone,
            ]);
        }else{
            $place->update([
            'name' => $request->name,
            'description' => $request->description,
            'url_image' => $request->url_image,
            'services' => implode(', ', $request->services),
            'category' => $request->category,
            'place_fishes' => implode(', ', $request->place_fishes),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'city_id' => $request->city_id,
            'state_id' => $request->state_id,
            'phone' => $request->phone,
            ]);

        }

        return redirect('/places');

    }

    public function delete($id)
    {
        $place = Place::findOrfail($id);

        $place->delete();

        return redirect('/places');
    }
    
//===================================== API ==========================================
    
    public function allplaces()
    {

        echo Place::select(
                    'places.*',
                    'cities.name AS city_name',
                    'states.name AS state_name',
            ) 
            ->join('cities', 'cities.id', '=', 'places.city_id')
            ->join('states', 'states.id', '=', 'places.state_id')
            ->get();

    }

    public function place($id)
    {
        $place = Place::select(
                    'places.*',
                    'cities.name AS city_name',
                    'states.name AS state_name',
            )
            ->join('cities', 'cities.id', '=', 'places.city_id')
            ->join('states', 'states.id', '=', 'places.state_id')
            ->where('places.id', $id)
            ->get();

        foreach ($place as $hsl)
        {

            $name = $hsl->name;
            $description = $hsl->description;
            $url_image = $hsl->url_image;
            $services = $hsl->services;
            $category = $hsl->category;
            $place_fishes = $hsl->place_fishes;
            $latitude = $hsl->latitude;
            $longitude = $hsl->longitude;
            $phone = $hsl->phone;
            $city_name = $hsl->city_name;
            $state_name = $hsl->state_name;
             
        }

        return json_encode(array("response"=>"success",
            "name"=>$name,
            "description"=>$description,
            "url_image"=>$url_image,
            "services"=>$services,
            "category"=>$category,
            "place_fishes"=>$place_fishes,
            "latitude"=>$latitude,
            "longitude"=>$longitude,
            "phone"=>$phone,
            "city_name"=>$city_name,
            "state_name"=>$state_name,
        ));
    }

    public function allcoordinates()
    {

        echo Place::select(
            'places.id',
            'places.name',
            'places.latitude',
            'places.longitude',
        )->get();

    }

//===================================== API ==========================================

}
