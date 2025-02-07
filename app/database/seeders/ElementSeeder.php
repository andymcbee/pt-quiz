<?php

namespace Database\Seeders;

use App\Models\Element;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use League\Csv\Reader;

class ElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvPath = storage_path('app/csv/elements.csv');


        if (!File::exists($csvPath)) {
            $this->command->error("CSV file not found at: $csvPath");
            return;
        }

        $csv = Reader::createFromPath($csvPath, 'r');
        $csv->setHeaderOffset(0);

        $elementRecords = $csv->getRecords();

        foreach ($elementRecords as $element) {
            Element::create([
                'name' => $element['Element'] ?? null,
                'symbol' => $element['Symbol'] ?? null,
                'atomic_number' => $element['AtomicNumber'] ?? null,
                'atomic_mass' => $element['AtomicMass'] ?? null,
            ]);
        }
    }
}
