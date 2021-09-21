<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExperienceCollection;
use App\Http\Resources\ExperienceResource;
use App\Models\Experience;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ExperienceCollection
     */
    public function index()
    {
        return new ExperienceCollection(Experience::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $experience = new Experience($request->all());
        Auth('sanctum')->user()->experiences()->save($experience);

        return response([
            'message' => 'Successfully created.',
            'data' => new ExperienceResource($experience)
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param Experience $experience
     * @return ExperienceResource
     */
    public function show(Experience $experience)
    {
        return new ExperienceResource($experience);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Experience $experience
     * @return Application|Response|ResponseFactory
     */
    public function update(Request $request, Experience $experience)
    {
        $experience->update($request->all());

        return response([
            'message' => 'Successfully updated.',
            'data' => new ExperienceResource($experience)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Experience $experience
     * @return Application|Response|ResponseFactory
     */
    public function destroy(Experience $experience)
    {
        $experience->delete();

        return response([
            'message' => 'Successfully deleted.'
        ], 200);
    }

    /**
     * Search the resource.
     *
     * @param Request $request
     * @param string $keyword
     * @return ExperienceCollection
     */
    public function search(Request $request, string $keyword)
    {
        $results = Experience::where(function ($query) use($keyword) {
            foreach (Experience::$searchColumns as $column) {
                $query->orWhere($column, 'like', '%' . trim($keyword) . '%');
            }
        })->get();

        return new ExperienceCollection($results);
    }
}
