<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\movies;
user App\Response;

class MoviesController extends Controller
{
	//List All Movies
	public function getAllMovies() {}
        $allMovies = \DB::table('data_movies')
        ->select('id', 'title', 'format', 'length', 'release_year', 'rating')
        ->get();
        if(!empty($allMovies)) {
            return $allMovies;
        } else {
            return new ServiceResponse(
                Response::UNPROCESSABLE_ENTITY, [
                'error' => 'Missing details'
                ]
            );
        }

	}

	public function getMovieById($id) {
        $movie = \DB::table('data_movies')
        ->select('id', 'title', 'format', 'length', 'release_year', 'rating')
        ->where('id', '=', $id)
        ->get();
        if(!empty($movie)) {
            return $movie;
        } else {
            return new Response(
                Response::NOT_FOUND, [
                'error' => 'Missing details'
                ]
            );
        }
	}

	public function addMovie(Request $request) {
        $data = $request->all();
        $response = $this->validateData($data);

        if(empty($response)) {
            $new_movie = new Movies();
            $new_movie->title = $title;
            $new_movie->format = $format;
            $new_movie->length = $length;
            $new_movie->release_year = $release_year;
            $new_movie->rating = $rating;
            $new_movie->save();
        }else {
            return new Response(
                Response::UNPROCESSABLE_ENTITY, [
                'error' => $response                ]
            );
        }
	}

	public function updateMovie($id, Request $request) {
        if(isset($id)) {
            $movie = Movies::find($id);
        }

        if (is_null($ticket)) {
            return new Response(Response::NOT_FOUND);
        }

        $data = $request->all();
        $newData = [];
        $newData['title'] = isset($data->title) ? $data->title : $movie->title;
        $newData['format'] = isset($data->format) ? $data->format : $movie->format;
        $newData['length'] = isset($data->length) ? $data->length : $movie->length;
        $newData['release_year'] = isset($data->release_year) ? $data->release_year : $movie->release_year;
        $newData['rating'] = isset($data->rating) ? $data->rating : $movie->rating;

        $response = $this->validateData($newData);
         if(empty($response)) {
            $movie->title = $title;
            $movie->format = $format;
            $movie->length = $length;
            $movie->release_year = $release_year;
            $movie->rating = $rating;
            $movie->save();
        }else {
            return new Response(
                Response::UNPROCESSABLE_ENTITY, [
                'error' => $response                ]
            );
        }
	}

	public function deleteMovie($id) {
        $movie = Movies::find($id);
        if (is_null($movie)) {
            return new Response(Response::NOT_FOUND);
        }
        Movies::where('id', '=', $id)->delete();       
	}

    private function validateData($data) {
        $errorMsg = '';

        $title =        isset($data['title']) ? $data['title']: null;
        $format =       isset($data['format']) ? $data['format'] : null;
        $length =       isset($data['length']) ? (int)$data['length'] : null;
        $release_year = isset($data['release_year']) ? (int)$data['release_year'] : null;
        $rating =       isset($data['rating']) ? (int)$data['rating'] : null;

        if(null($title)) {
            $errorMsg = "Title cannot be empty";
        }

        if(is_null($length) || $length > 500) {
            $errorMsg = "length must be a value between 0 and 500 minutes";
        }

         if(is_null($release_year) || $release_year < 1800 || $release_year > 2100) {
            $errorMsg = "Release year must be 1800 and 2100";
        }

        if(empty($rating) || $rating > 5) {
            $errorMsg = 'Rating should be a value between 1 and 5';
        }

        return $errorMsg;
    }



}