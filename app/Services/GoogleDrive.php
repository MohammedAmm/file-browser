<?php

namespace App\Services;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_FileList;

class GoogleDrive
{

    private $drive;

    public function __construct()
    {
        $client=resolve(Google_Client::class);
        $this->drive = new Google_Service_Drive($client);
    }

    public function listFolderContent(string $nextPageToken = null, string $folderId='root', int $pageSize=10) :Google_Service_Drive_FileList
    {
        //Filter query for reterving all files except folders, and not trashed
        //By default if noot folder_id passed will list all files
        $query = "mimeType!='application/vnd.google-apps.folder' and '" . $folderId . "' in parents and trashed=false";


        $optionalParams = [
            'pageSize'  => $pageSize,
            'pageToken' => $nextPageToken ?? '',
            'fields'    => "nextPageToken, files(id,name,webContentLink,size,mimeType)",
            'q'         => $query,
        ];

        return $this->drive->files->listFiles($optionalParams);
    }
}
