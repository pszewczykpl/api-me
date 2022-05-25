<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'position' => $this->position,
            'company' => $this->company,
            'from_date' => $this->from_date,
            'to_date' => $this->when(! (boolean) $this->currently_working, $this->to_date),
            'currently_working' => $this->currently_working,
            'description' => $this->description,
            'localization' => $this->localization,
            'user_id' => $this->user->id,
        ];
    }
}
