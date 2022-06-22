<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class GalleriesController extends Controller
{
    
    public function store(Request $request)
    {

        if ($request->hasFile('url_photo')) {

            $extension = $request->url_photo->extension();
            $nameFile =  random_int(1000000, 99999999).".".$extension;
            $upload = $request->url_photo->storeAs('public/gallery', $nameFile);

            if ( !$upload ){
                return json_encode(array("response"=>"upload_failed"));
            }else{

                $ch = curl_init();
                $data = array('image' => env('APP_URL').'/storage/gallery/'.$nameFile);
                curl_setopt($ch, CURLOPT_URL, 'https://api.imgbb.com/1/upload?key=2695e11befcab2be06f3ab072ef46067');
                curl_setopt($ch, CURLOPT_POST, 1);
                //CURLOPT_SAFE_UPLOAD defaulted to true in 5.6.0
                //So next line is required as of php >= 5.6.0
                curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $return = curl_exec($ch);

                curl_close($ch);

            }
            
        }

        $json = json_decode($return);

        if ($json->data->url) {
            $sql = Gallery::create([
                'place_id' => $request->place_id,
                'url_photo' => $json->data->url,
                'subtitle' => $request->subtitle,
            ]);

            Storage::delete('public/gallery/'.$nameFile);

            return redirect('/places/edit/'.$request->place_id);

        }else{

            return json_encode(array("response"=>"failed"));
        }

        return redirect('/places/edit/'.$request->place_id);

    }

    public function getallplace(Request $request)
    {

        echo Gallery::select(
                    'galleries.*',
                    'places.name AS place_name',
            )
            ->join('places', 'places.id', '=', 'galleries.place_id')
            ->where('galleries.place_id', $request->place_id)
            ->get();

    }

    public function getall()
    {

        echo Gallery::select(
                    'galleries.*',
                    'places.name AS place_name',
            ) 
            ->join('places', 'places.id', '=', 'galleries.place_id')
            ->get();

    }

    public function delete($place_id, $id)
    {
        $gallery = Gallery::findOrfail($id);

        $gallery->delete();

        return redirect('/places/edit/'.$place_id);
    }

}
