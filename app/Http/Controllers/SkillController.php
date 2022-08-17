<?php

namespace App\Http\Controllers;

use App\Http\Resources\SkillCollection;
use App\Http\Resources\SkillResource;
use App\Models\Skill;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return SkillCollection
     */
    public function index(): SkillCollection
    {
        return new SkillCollection(Skill::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $skill = new Skill($request->all());
        Auth('sanctum')->user()->skills()->save($skill);

        return response([
            'message' => 'Successfully created.',
            'data' => new SkillResource($skill)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Skill $skill
     * @return SkillResource
     */
    public function show(Skill $skill): SkillResource
    {
        return new SkillResource($skill);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Skill $skill
     * @return Response
     */
    public function update(Request $request, Skill $skill): Response
    {
        $skill->update($request->all());

        return response([
            'message' => 'Successfully updated.',
            'data' => new SkillResource($skill)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Skill $skill
     * @return Response
     */
    public function destroy(Skill $skill): Response
    {
        $skill->delete();

        return response([
            'message' => 'Successfully deleted.'
        ], 200);
    }
}
