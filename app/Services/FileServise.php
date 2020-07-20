<?php


namespace App\Services;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileServise
{
    /**
     * Сохраняем файл на диск
     *
     * @param  string  $file
     * @return string
     */
    public function saveFile($file){
            $ras = $file->extension();
            $path = $file->storeAs('public', Auth::id() . '_' . date('d_m_Y_H_i_s').'.'.$ras);
            $url = Storage::url($path);
            return $url;
    }

    /**
     * Удаляем файл с диска
     *
     * @param  string  $file
     * @return string
     */
    public function deleteFile($file){
        $file = str_replace('storage', 'public', $file);
        if (Storage::delete($file)){
            return true;
        }else return false;

    }
}