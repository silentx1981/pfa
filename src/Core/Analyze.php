<?php

namespace Raffaelwyss\Pfa\Core;

use DateTime;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class Analyze
	extends App
{
	private $categories = [];

	public function __construct()
	{
		$this->categories = json_decode(file_get_contents('../config/categories.json'), true);
	}

	public function run()
	{

		$route = $this->getRouteName();

		$x = json_decode(file_get_contents("php://input"), true);
		if (!isset($x['message']))
			$x['message'] = 'Start';

		if ($route === 'base') {
			echo file_get_contents('../templates/markup.html');
			return;
		}

		if ($route === 'base.data') {
			$array['message'] = "$x[message] 12345";

			print_r(json_encode($array));
		}
	}

	public function analyze($file)
	{
		$data = $this->getArrayFromFile($file);
		$data = $this->removeDataWithoutDate($data);
		$parsed = $this->parseData($data);
		$calculated = $this->calculateData($parsed);
		$result = [
			'calculated' => $calculated,
			'parsed'     => $parsed,
			'raw'        => $data,
		];

		echo '<pre>';
		print_r($result);
	}

	private function calculateData($data)
	{
		$result = [];
		foreach ($data as $category => $values) {
			$result[$category] = [
				'total' => 0,
			];
			foreach ($values as $value)
				$result[$category]['total'] += $value[3] ?? 0;
		}

		return $result;
	}

	private function getArrayFromFile($file)
	{
		$reader = new Csv();
		$reader->setInputEncoding('ISO-8859-15');
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

	private function parseData(array $data)
	{
		$result = [
			'undefined' => [],
		];
		foreach ($data as $value) {
			$textFound = false;
			foreach ($this->categories as $category => $rule) {
				if (!isset($result[$category]))
					$result[$category] = [];

				foreach ($rule as $text) {
					if (strpos($value[1], $text) && !$textFound) {
						$result[$category][] = $value;
						$textFound = true;
					}
				}
			}

			if (!$textFound)
				$result['undefined'][] = $value;
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
