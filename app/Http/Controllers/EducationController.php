<?php

namespace App\Http\Controllers;

use App\Http\Resources\EducationCollection;
use App\Http\Resources\EducationResource;
use App\Models\Education;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EducationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return EducationCollection
     */
    public function index(): EducationCollection
    {
        return new EducationCollection(Education::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $education = new Education($request->all());
        Auth('sanctum')->user()->educations()->save($education);

        return response([
            'message' => 'Successfully created.',
            'data' => new EducationResource($education)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Education $education
     * @return EducationResource
     */
    public function show(Education $education): EducationResource
    {
        return new EducationResource($education);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Education $education
     * @return Response
     */
    public function update(Request $request, Education $education): Response
    {
        $education->update($request->all());

        return response([
            'message' => 'Successfully updated.',
            'data' => new EducationResource($education)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Education $education
     * @return Response
     */
    public function destroy(Education $education): Response
    {
        $education->delete();

        return response([
            'message' => 'Successfully deleted.'
        ], 200);
    }

    /**
     * Search the resource.
     *
     * @param Request $request
     * @param string $keyword
     * @return EducationCollection
     */
    public function search(Request $request, string $keyword): EducationCollection
    {
        $results = Education::where(function ($query) use($keyword) {
            foreach (Education::$searchColumns as $column) {
                $query->orWhere($column, 'like', '%' . trim($keyword) . '%');
            }
        })->get();

        return new EducationCollection($results);
    }
}
