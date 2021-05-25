<?php

namespace App\Services\Import;

use App\Events\ImportConfirmed;
use App\Models\Import;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Services\Import\Exceptions\CannotOpenFileException;
use App\Services\Import\Exceptions\WrongFileException;
use Illuminate\Http\Request;
use DB;

class ImportService
{

    public function create(Request $request): Import
    {
        $path = $request->file('file')->store('import');

        $f = $this->openFile($path);

        $fields = fgetcsv($f);
        fclose($f);

        if (empty($fields)) {
            throw new WrongFileException;
        }

        $mapping = [];
        foreach ($fields as $field) {
            $mapping[$field] = $field;
        }

        return Import::create([
            'file'    => $path,
            'mapping' => $mapping,
        ]);
    }

    public function confirm(Request $request, Import $import)
    {
        $import->mapping = $request->validated();
        $import->confirm();
        $import->save();

        ImportConfirmed::dispatch($import);
    }

    public function execute(Import $import)
    {
        $f = $this->openFile($import->file);

        $fields = fgetcsv($f);

        if (empty($fields)) {
            throw new WrongFileException;
        }

        DB::transaction(function () use ($f, $fields, $import) {
            $mapping = [];
            foreach ($fields as $index => $field) {
                if (in_array($field, $import->mapping)) {
                    $mapping[$index] = ProductAttribute::firstOrCreate([
                        'name' => $import->mapping[$field],
                    ]);
                }
            }

            while (($data = fgetcsv($f)) !== false) {
                $product = Product::create();
                foreach ($mapping as $index => $productAttribute) {
                    $productAttributeValue = new ProductAttributeValue;
                    $productAttributeValue->value = $data[$index];
                    $productAttributeValue->product()->associate($product);
                    $productAttributeValue->productAttribute()->associate($productAttribute);
                    $productAttributeValue->save();
                }
            }
        });

        fclose($f);
    }

    /**
     * @param string $path
     *
     * @return resource
     */
    private function openFile(string $path)
    {
        $fullPath  = storage_path('app/' . $path);

        $f = fopen($fullPath, "r");
        if ($f === false) {
            throw new CannotOpenFileException;
        }

        return $f;
    }
}
