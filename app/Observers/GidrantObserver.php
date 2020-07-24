<?php

namespace App\Observers;

use App\Models\Gidrant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GidrantObserver
{
    /**
     * События перед созданием и обновлением
     *
     * @param  \App\Models\Operplan  $operplan
     * @return void
     */
    public function saving(Gidrant $operplan)
    {
        /*if (request()->hasFile('inputFile')){
            $addfile = request()->file('inputFile');
            $ras = $addfile->extension();
            $path = $addfile->storeAs('public', Auth::id() . '_' . date('d_m_Y_H_i_s').'.'.$ras);
            $url = Storage::url($path);
            $operplan->file = $url;
        }*/
    }

    /**
     * Handle the gidrant "created" event.
     *
     * @param  \App\Models\Gidrant  $gidrant
     * @return void
     */
    public function created(Gidrant $gidrant)
    {
        //
    }

    /**
     * Handle the gidrant "updated" event.
     *
     * @param  \App\Models\Gidrant  $gidrant
     * @return void
     */
    public function updated(Gidrant $gidrant)
    {
        //
    }

    /**
     * Handle the gidrant "deleted" event.
     *
     * @param  \App\Models\Gidrant  $gidrant
     * @return void
     */
    public function deleted(Gidrant $gidrant)
    {
        //
    }

    /**
     * Handle the gidrant "restored" event.
     *
     * @param  \App\Models\Gidrant  $gidrant
     * @return void
     */
    public function restored(Gidrant $gidrant)
    {
        //
    }

    /**
     * Handle the gidrant "force deleted" event.
     *
     * @param  \App\Models\Gidrant  $gidrant
     * @return void
     */
    public function forceDeleted(Gidrant $gidrant)
    {
        //
    }
}
