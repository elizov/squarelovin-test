<?php

namespace App\Http\Controllers;

use App\Http\Requests\Import\StoreRequest;
use App\Http\Requests\Import\UpdateRequest;
use App\Models\Import;
use App\Services\Import\ImportService;

class ImportController extends Controller
{

    /**
     * @var ImportService
     */
    private $importService;

    public function __construct(ImportService $importService)
    {
        $this->importService = $importService;
    }

    public function create()
    {
        return view('import.create');
    }

    public function store(StoreRequest $request)
    {
        $import = $this->importService->create($request);

        return redirect()->route('import.edit', $import);
    }

    public function edit(Import $import)
    {
        return view('import.edit', [
            'import' => $import,
        ]);
    }

    public function update(UpdateRequest $request, Import $import)
    {
        $this->importService->confirm($request, $import);

        return redirect()->route('import.create');
    }
}
