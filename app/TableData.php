<?php

namespace App;

use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\TabularDataReader;

class TableData
{
    private $csv;

    public function readData(string $filePath): TabularDataReader
    {
        $this->csv = Reader::createFromPath($filePath, 'r');
        $this->csv->setDelimiter(';');
        $this->csv->setHeaderOffset(0);

        return Statement::create()->process($this->csv);
    }

    public function records(TabularDataReader $data, string $search): array
    {
        $records = $data->getRecords();
        $selectedRecords = [];
        if (empty($search)) {
            return iterator_to_array($records);
        } else {
            foreach ($records as $record) {
                if ($record['Valsts'] === $search) {
                    $selectedRecords[] = $record;
                }
            }
            return $selectedRecords;
        }
    }

    public function headers(): array
    {
        return $this->csv->getHeader();
    }
}