<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LofyService {

        protected $site = "https://api.freetouse.com/v3";

        public function all_tracks() {

            $response = Http::get( $this->site . '/music/tracks/all',['sort' =>'desc','limit' =>12]);

            if ( $response->successful() ) {

                return $response['data'];
            }

            else{

                return [];
            }

        }


        public function recents_tracks(){

            $response = Http::get($this->site.'/music/tracks/all',['sort'=>'desc']);

            if ( $response->successful() ) {

                return $response['data'];
            }

            else{

                    return [];
                }

        }

        public function olds_tracks(){

            $response = Http::get( $this->site . '/music/tracks/all',['sort'=>'asc']);

            if ( $response->successful() ) {

                return $response['data'];
            }

            else{

                    return [];
                }

        }

        public function all_categories () {

            $response = Http::get( $this->site . '/music/categories/all', []);

            if ( $response->successful() ){

                return $response['data'];
            }

            else{
                return [];
            }

        }

        public function recents_categories(){

                $response = Http::get($this->site . '/music/categories/all', [
                    'limit' => 18,
                    'sort' => 'desc',
                ]);

                if ($response->successful()) {
                    return $response['data'];
                }

                return [];
            }

        public function olds_categories(){

            $response = Http::get($this->site . '/music/categories/all', [
                'limit' => 18,
                'sort' => 'asc',
            ]);

            if ($response->successful()) {
                return $response['data'];
            }

            return [];
        }

        public function category_details( string $category_id) {

            $response = Http::get( $this->site ."/music/categories/{$category_id}");

            if ( $response->successful() )  {

                return $response['data'];
            }

            else{
                
                return [];
            }

        }

        public function all_artists(){

            $response = Http::get($this->site. '/music/artists/all',['limit'=>12]);

            if ( $response->successful() ){

                return $response['data'];
            }

            else{

                return [];
            }
        }

        public function artist_details( string $artist_id) {

            $response = Http::get( $this->site ."/music/artists/{$artist_id}");

            if ( $response->successful() )  {

                return $response['data'];
            }

            else{
                
                return [];
            }

        }


        public function search_track(string $term){

            $response = Http::get($this->site ."/music/tracks/search", ['query'=>$term,'limit'=>12] );

           if( $response->successful() ) { 

                return $response['data'];
           } 

            else{
                return [];
            }
        }


        public function track_details(string $track_id) {

            $response = Http::get($this->site ."/music/tracks/{$track_id}");

           if( $response->successful() ) { 

                return $response['data'];
           } 

            else{

                return [];
            }
        }

        public function category_tracks(string $category_id){

            $response = Http::get($this->site ."/music/categories/{$category_id}/tracks",['limit'=>12]);

           if( $response->successful() ) { 

                return $response['data'];
           } 

            else{

                return [];
            }

        }

}