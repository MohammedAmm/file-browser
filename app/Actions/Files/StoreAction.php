<?php

namespace App\Actions\Files;

use App\File;
use App\Actions\Action;
use App\Actions\ActionInterface;

class StoreAction extends Action implements ActionInterface
{
    //Holds next page token
    protected $nextPageToken = null;
    //Holds Files
    protected $files = null;
    public function execute()
    {
        //Get file_ids and check if already exists to reduce sql queries.
        $onlineIds = File::get('online_id')->pluck('online_id')->toArray();
        collect($this->files)->each(function ($file) use ($onlineIds) {
            if (!in_array($file->id, $onlineIds)) {
                File::create(
                    [
                        'online_id'    => $file->id,
                        'title'        => $file->name,
                        'download_url' => $file->webContentLink,
                        'size'         => $file->size,
                        'mime_type'    => $file->mimeType,
                    ]);
            }
        });
    }
}
