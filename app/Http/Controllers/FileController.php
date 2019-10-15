<?php

namespace App\Http\Controllers;

use App\Actions\Files\FetchAllAction;

class FileController extends Controller
{
    public function index()
    {
        $files = FetchAllAction::run();

        return view('files.index', ['files' => $files]);
    }
}
