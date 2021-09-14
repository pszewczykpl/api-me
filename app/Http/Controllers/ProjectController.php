<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ProjectCollection
     */
    public function index()
    {
        return new ProjectCollection(Project::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $project = Project::create($request->all());

        return response([
            'message' => 'Successfully created.',
            'data' => new ProjectResource($project)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return ProjectResource
     */
    public function show(Project $project)
    {
        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Project $project
     * @return Response
     */
    public function update(Request $request, Project $project)
    {
        $project->update($request->all());

        return response([
            'message' => 'Successfully updated.',
            'data' => new ProjectResource($project)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return response([
            'message' => 'Successfully deleted.'
        ], 200);
    }

    /**
     * Search the resource.
     *
     * @param Request $request
     * @param string $keyword
     * @return ProjectCollection
     */
    public function search(Request $request, string $keyword)
    {
        $results = Project::where(function ($query) use($keyword) {
            foreach (Project::$searchColumns as $column) {
                $query->orWhere($column, 'like', '%' . trim($keyword) . '%');
            }
        })->get();

        return new ProjectCollection($results);
    }
}