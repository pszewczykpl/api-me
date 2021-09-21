<?php

namespace App\Http\Controllers;

use App\Http\Resources\HobbyCollection;
use App\Http\Resources\HobbyResource;
use App\Models\Hobby;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return HobbyCollection
     */
    public function index()
    {
        return new HobbyCollection(Hobby::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $hobby = new Hobby($request->all());
        Auth('sanctum')->user()->hobbies()->save($hobby);

        return response([
            'message' => 'Successfully created.',
            'data' => new HobbyResource($hobby)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Hobby $hobby
     * @return HobbyResource
     */
    public function show(Hobby $hobby)
    {
        return new HobbyResource($hobby);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Hobby $hobby
     * @return Response
     */
    public function update(Request $request, Hobby $hobby)
    {
        $hobby->update($request->all());

        return response([
            'message' => 'Successfully updated.',
            'data' => new HobbyResource($hobby)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Hobby $hobby
     * @return Response
     */
    public function destroy(Hobby $hobby)
    {
        $hobby->delete();

        return response([
            'message' => 'Successfully deleted.'
        ], 200);
    }

    /**
     * Search the resource.
     *
     * @param Request $request
     * @param string $keyword
     * @return HobbyCollection
     */
    public function search(Request $request, string $keyword)
    {
        $results = Hobby::where(function ($query) use($keyword) {
            foreach (Hobby::$searchColumns as $column) {
                $query->orWhere($column, 'like', '%' . trim($keyword) . '%');
            }
        })->get();

        return new HobbyCollection($results);
    }
}
