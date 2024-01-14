<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'identify' => $this->id,
            'subject' => strtoupper($this->subject),
            'content' => $this->body,
            'created_at' => Carbon::make($this->created_at)->format('Y-m-d'),
        ];
    }
}
