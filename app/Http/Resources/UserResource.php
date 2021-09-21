<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'about' => $this->description,
            'contact' => [
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
            ],
            'website' => $this->www,
            'social_media' => [
                'linkedin' => $this->social_linkedin,
                'github' => $this->social_github,
                'facebook' => $this->social_facebook,
                'twitter' => $this->social_twitter,
            ],
            'experiences' => new ExperienceCollection($this->experiences),
            'educations' => new EducationCollection($this->educations),
            'projects' => new ProjectCollection($this->projects),
            'skills' => new SkillCollection($this->skills),
            'hobbies' => new HobbyCollection($this->hobbies),
        ];
    }
}
