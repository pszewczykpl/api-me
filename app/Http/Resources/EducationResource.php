<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
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
            'id' => $this->id,
            'university' => $this->university,
            'degree' => $this->degree,
            'field_of_study' => $this->field_of_study,
            'from_date' => $this->from_date,
            'to_date' => $this->when(! (boolean) $this->currently_study, $this->to_date),
            'currently_study' => $this->currently_study,
            'description' => $this->description,
            'localization' => $this->localization,
            'user_id' => $this->user->id,
        ];
    }
}
