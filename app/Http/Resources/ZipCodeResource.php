<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ZipCodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
          'zip_code'       => $this->zip_code,
          'locality'       => $this->locality,
          'federal_entity' => [
            'key'  => $this->federal_entity_key,
            'name' => $this->federal_entity_name,
            'code' => $this->federal_entity_code
          ],
          'settlements'    => json_decode($this->settlements),
          'municipality'   => [
            'key'  => $this->municipality_key,
            'name' => $this->municipality_name,
          ],
        ];
    }
}
