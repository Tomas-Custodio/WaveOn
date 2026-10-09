<?php

namespace App\Http\Controllers;

use App\Services\LofyService;
use Illuminate\Support\collection;
use Illuminate\Http\Request;


class LofyController extends Controller {
    protected LofyService $lofy;
    public function __construct()
    {
        $this->lofy = new LofyService();
    }

    public function all_tracks() {

        $tracks = $this->lofy->all_tracks();
        return view('Public.Tracks.index', compact('tracks'));
    }

     public function recents_tracks() {

        $tracks = $this->lofy->all_tracks();
        return view('Public.Tracks.recents', compact('tracks'));
    }

     public function old_tracks() {

        $tracks = $this->lofy->all_tracks();
        return view('Public.Tracks.olds', compact('tracks'));
    }


    public function track_details(string $track_id){

        $track_found = $this->lofy->track_details($track_id);
        return view('Public.Tracks.details',compact('track_found'));
        
    }

    public function all_categories() {

        $categories = $this->lofy->all_categories();
        return view('Public.Categories.index', compact('categories'));
    }

    public function recents_categories() {

        $categories = $this->lofy->recents_categories();
        return view('Public.Categories.recents', compact('categories'));
    }

    public function olds_categories(){

        $categories = $this->lofy->olds_categories();
        return view('Public.Categories.olds', compact('categories'));

    }

    /* public function category_tracks(string $category_id){

        $tracks_found = $this->lofy->category_details($category_id);
        return view('Public.Categories.tracks',compact('tracks_found'));

    } */

    public function category_details(string $category_id){

       $category_found = $this->lofy->category_details($category_id);
       $category_tracks = $this->lofy->category_tracks($category_id);

       

       #dd($category_found);

        return view('Public.Categories.details', compact('category_found','category_tracks'));

    }

    public function search_track(Request $request) {

        $term = $request->input('search');

        if ($term === null || trim($term) === ''){ 
            
            return view('Public.Tracks.search',compact('term'));}

        else{

            $track_found = $this->lofy->search_track($term);
            return view('Public.Tracks.search', compact('track_found','term'));  

        }      
    }

    public function all_artists(){

        $artists = $this->lofy->all_artists();
        return view("Public.Artists.index",compact('artists'));
    }

    public function artist_details(string $track_id){

        $artist_found = $this->lofy->artist_details($track_id);
        return view('Public.Artists.details',compact('artist_found'));
        
    }

}