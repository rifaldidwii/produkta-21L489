<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ScheduleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($schedule) {
            [
                'id' => $schedule->id,
                'title' => $schedule->classroom->name . ' - ' . $schedule->classroom->subject->name . ' ' . $schedule->classroom->subject->grade,
                'start' => $schedule->start_time,
                'end' => $schedule->end_time,
                'color' => $schedule->color
            ];
        });
    }
}
