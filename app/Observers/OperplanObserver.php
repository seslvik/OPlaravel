<?php

namespace App\Observers;

use App\Models\Operplan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OperplanObserver
{
    /**
     * События перед созданием и обновлением
     *
     * @param  \App\Models\Operplan  $operplan
     * @return void
     */
    public function saving(Operplan $operplan)
    {
        if (request()->hasFile('inputFile')){
            $addfile = request()->file('inputFile');
            $ras = $addfile->extension();
            $path = $addfile->storeAs('public', Auth::id() . '_' . date('d_m_Y_H_i_s').'.'.$ras);
            $url = Storage::url($path);
            $operplan->file = $url;
        }
    }

    /**
     * Handle the operplan "created" event.
     *
     * @param  \App\Models\Operplan  $operplan
     * @return void
     */
    public function created(Operplan $operplan)
    {
        //
    }

    /**
     * Handle the operplan "updated" event.
     *
     * @param  \App\Models\Operplan  $operplan
     * @return void
     */
    public function updated(Operplan $operplan)
    {
        //
    }

    /**
     * Handle the operplan "deleted" event.
     *
     * @param  \App\Models\Operplan  $operplan
     * @return void
     */
    public function deleted(Operplan $operplan)
    {
        //
    }

    /**
     * Handle the operplan "restored" event.
     *
     * @param  \App\Models\Operplan  $operplan
     * @return void
     */
    public function restored(Operplan $operplan)
    {
        //
    }

    /**
     * Handle the operplan "force deleted" event.
     *
     * @param  \App\Models\Operplan  $operplan
     * @return void
     */
    public function forceDeleted(Operplan $operplan)
    {
        //
    }
}
