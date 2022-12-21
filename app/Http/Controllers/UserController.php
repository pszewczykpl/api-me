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
     * @return UserResource
     */
    public function profile(Request $request): UserResource
    {
        /**
         * Currently app supports only one user, so we can just return the first one.
         */
        $user = User::first();

        return new UserResource($user);
    }
}
