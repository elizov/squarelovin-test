<?php

namespace App\Events;

use App\Models\Import;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ImportConfirmed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Import
     */
    private $import;

    public function __construct(Import $import)
    {
        $this->import = $import;
    }

    public function getImport(): Import
    {
        return $this->import;
    }
}
