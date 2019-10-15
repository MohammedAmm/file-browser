<?php

namespace App\Actions\Files;

use App\File;
use App\Actions\Action;
use App\Actions\ActionInterface;

class FetchAllAction extends Action implements ActionInterface
{
    //Model to fetch data from
    protected $model=File::class;

    public function execute()
    {
        return $this->model::simplePaginate(10);
    }
}
