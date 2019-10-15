<?php

namespace App\Http\Controllers;

use App\Jobs\SyncFilesLocallyJob;

class DriveController extends Controller
{
    public function sync()
    {
        SyncFilesLocallyJob::dispatch();

        return view('thanks');

    }
}
