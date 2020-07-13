<?php


namespace App\Repositories;

/**
 * Create a class OperplanRepository.
 *
 *
 */
class OperplanRepository
{
    /**
     *
     * @return string
     */
    protected function getModel()
    {
        $this->middleware('auth');
    }


}
