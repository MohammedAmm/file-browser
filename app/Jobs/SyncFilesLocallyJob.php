<?php

namespace App\Jobs;

use App\Actions\Files\Store;
use App\Actions\Files\StoreAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\GoogleDrive;

class SyncFilesLocallyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $nextPageToken;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $nextPageToken=null) {
        $this->nextPageToken=$nextPageToken;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $drive = new GoogleDrive();
        //Get Folder 'root' files
        $results = $drive->listFolderContent($this->nextPageToken);

        $this->nextPageToken = $results->nextPageToken;

        $files=$results->getFiles();

        StoreAction::run(['files'=>$files,'nextPageToken'=>$this->nextPageToken]);

        logger($this->nextPageToken);

        if ($this->nextPageToken) {
            # code...
            SyncFilesLocallyJob::dispatch($this->nextPageToken);
        }
    }
}
