<?php

namespace App\Console\Commands;

use App\Services\FormImporter;
use Illuminate\Console\Command;

class ImportForm extends Command
{
    protected $signature = 'form:import';

    protected $description = 'Import form definition from JSON into database';

    public function handle(FormImporter $importer): int
    {
        $importer->import();

        $this->info('Form berhasil diimport.');

        return self::SUCCESS;
    }
}