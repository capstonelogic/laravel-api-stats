<?php

namespace CapstoneLogic\Stats\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class StatsResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        
        return [
            'id' => $this->id,
            'title' => $this->title,
            'key' => $this->key,
            'position' => $this->position,
            'counter' => $this->counters->sum('counter'),
            'icon' => $this->icon,
            'css_classes' => $this->css_classes,
        ];
    }
}
