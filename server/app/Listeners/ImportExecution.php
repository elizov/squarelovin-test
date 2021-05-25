<?php

namespace App\Listeners;

use App\Events\ImportConfirmed;
use App\Services\Import\ImportService;

class ImportExecution
{

    private $importService;

    public function __construct(ImportService $importService)
    {
        $this->importService = $importService;
    }

    public function handle(ImportConfirmed $event)
    {
        $this->importService->execute($event->getImport());
    }
}
