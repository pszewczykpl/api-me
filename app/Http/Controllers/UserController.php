<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\EducationCollection;
use App\Http\Resources\ExperienceCollection;
use App\Http\Resources\ExperienceResource;
use App\Http\Resources\HobbyCollection;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\SkillCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @param User $user
     * @return UserResource
     */
    public function profile(Request $request, User $user) {
        return new UserResource($user);
    }

    public function userExperiences(Request $request, User $user) {
        return new ExperienceCollection($user->experiences);
    }

    public function userEducations(Request $request, User $user) {
        return new EducationCollection($user->educations);
    }

    public function userProjects(Request $request, User $user) {
        return new ProjectCollection($user->projects);
    }

    public function userSkills(Request $request, User $user) {
        return new SkillCollection($user->skills);
    }

    public function userHobbies(Request $request, User $user) {
        return new HobbyCollection($user->hobbies);
    }
}
