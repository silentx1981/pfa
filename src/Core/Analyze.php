<?php

namespace Raffaelwyss\Pfa\Core;

use DateTime;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class Analyze
{
	public function analyze($file)
	{
		$data = $this->getArrayFromFile($file);
		$data = $this->removeDataWithoutDate($data);

		echo '<pre>';
		print_r($data);
	}

	private function getArrayFromFile($file)
	{
		$reader = new Csv();
		$reader->setReadDataOnly(true);
		$spreadsheet = $reader->load($file['tmp_name']);
		$worksheet = $spreadsheet->getActiveSheet();

		$result = [];
		foreach ($worksheet->getRowIterator() as $row) {
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(FALSE);
			$cells = [];
			foreach ($cellIterator as $cell) {
				$cells[] = $cell->getValue();
			}
			$result[] = $cells;
		}

		return $result;
	}

	private function removeDataWithoutDate(array $data)
	{
		$result = [];
		foreach ($data as $value) {
			if (!($value[0] ?? null))
				continue;

			$date = DateTime::createFromFormat('Y-m-d', $value[0]);
			if (!$date)
				continue;

			$result[] = $value;
		}

		return $result;
	}
}
