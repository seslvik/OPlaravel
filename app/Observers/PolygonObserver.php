<?php

namespace App\Observers;

use App\Models\Polygon;

class PolygonObserver
{
    /**
     * Handle the polygon "created" event.
     *
     * @param  \App\Models\Polygon  $polygon
     * @return void
     */
    public function created(Polygon $polygon)
    {
        //
    }

    /**
     * Handle the polygon "updated" event.
     *
     * @param  \App\Models\Polygon  $polygon
     * @return void
     */
    public function updated(Polygon $polygon)
    {
        //
    }

    /**
     * Handle the polygon "deleted" event.
     *
     * @param  \App\Models\Polygon  $polygon
     * @return void
     */
    public function deleted(Polygon $polygon)
    {
        //
    }

    /**
     * Handle the polygon "restored" event.
     *
     * @param  \App\Models\Polygon  $polygon
     * @return void
     */
    public function restored(Polygon $polygon)
    {
        //
    }

    /**
     * Handle the polygon "force deleted" event.
     *
     * @param  \App\Models\Polygon  $polygon
     * @return void
     */
    public function forceDeleted(Polygon $polygon)
    {
        //
    }
}
