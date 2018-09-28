<?php

namespace Maatwebsite\Excel;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Maatwebsite\Excel\Concerns\WithCharts;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class Writer
{
    use DelegatedMacroable, HasEventBus;

    /**
     * @var Spreadsheet
     */
    protected $spreadsheet;

    /**
     * @var object
     */
    protected $exportable;

    /**
     * @var string
     */
    protected $tmpPath;

    /**
     * @var string
     */
    protected $delimiter = ',';

    /**
     * @var string
     */
    protected $enclosure = '"';

    /**
     * @var string
     */
    protected $lineEnding = PHP_EOL;

    /**
     * @var bool
     */
    protected $useBom = false;

    /**
     * @var bool
     */
    protected $includeSeparatorLine = false;

    /**
     * @var bool
     */
    protected $excelCompatibility = false;

    /**
     * @var string
     */
    protected $file;

    /**
     * New Writer instance.
     */
    public function __construct()
    {
        $this->tmpPath = config('excel.exports.temp_path', sys_get_temp_dir());
        $this->applyCsvSettings(config('excel.exports.csv', []));
    }

    /**
     * @param object $export
     * @param string $writerType
     *
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * @return string
     */
    public function export($export, string $writerType): string
    {
        $this->open($export);

        $sheetExports = [$export];
        if ($export instanceof WithMultipleSheets) {
            $sheetExports = $export->sheets();
        }

        foreach ($sheetExports as $sheetExport) {
            $this->addNewSheet()->export($sheetExport);
        }

        return $this->write($export, $this->tempFile(), $writerType);
    }

    /**
     * @param object $export
     *
     * @return $this
     */
    public function open($export)
    {
        $this->exportable = $export;

        if ($export instanceof WithEvents) {
            $this->registerListeners($export->registerEvents());
        }

        $this->exportable  = $export;
        $this->spreadsheet = new Spreadsheet;
        $this->spreadsheet->disconnectWorksheets();

        $this->raise(new BeforeExport($this, $this->exportable));

        if ($export instanceof WithTitle) {
            $this->spreadsheet->getProperties()->setTitle($export->title());
        }

        return $this;
    }

    /**
     * @param string $tempFile
     * @param string $writerType
     *
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     * @return Writer
     */
    public function reopen(string $tempFile, string $writerType)
    {
        $reader            = IOFactory::createReader($writerType);
        $this->spreadsheet = $reader->load($tempFile);

        return $this;
    }

    /**
     * @param object $export
     * @param string $fileName
     * @param string $writerType
     *
     * @return string
     */
    public function write($export, string $fileName, string $writerType)
    {
        $this->exportable = $export;

        $this->raise(new BeforeWriting($this, $this->exportable));

        if ($export instanceof WithCustomCsvSettings) {
            $this->applyCsvSettings($export->getCsvSettings());
        }

        $writer = IOFactory::createWriter($this->spreadsheet, $writerType);

        if ($export instanceof WithCharts) {
            $writer->setIncludeCharts(true);
        }

        if ($writer instanceof Csv) {
            $writer->setDelimiter($this->delimiter);
            $writer->setEnclosure($this->enclosure);
            $writer->setLineEnding($this->lineEnding);
            $writer->setUseBOM($this->useBom);
            $writer->setIncludeSeparatorLine($this->includeSeparatorLine);
            $writer->setExcelCompatibility($this->excelCompatibility);
        }

        $writer->save($fileName);

        $this->spreadsheet->disconnectWorksheets();
        unset($this->spreadsheet);

        return $fileName;
    }

    /**
     * @param int|null $sheetIndex
     *
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @return Sheet
     */
    public function addNewSheet(int $sheetIndex = null)
    {
        return new Sheet($this->spreadsheet->createSheet($sheetIndex));
    }

    /**
     * @param string $delimiter
     *
     * @return Writer
     */
    public function setDelimiter(string $delimiter)
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    /**
     * @param string $enclosure
     *
     * @return Writer
     */
    public function setEnclosure(string $enclosure)
    {
        $this->enclosure = $enclosure;

        return $this;
    }

    /**
     * @param string $lineEnding
     *
     * @return Writer
     */
    public function setLineEnding(string $lineEnding)
    {
        $this->lineEnding = $lineEnding;

        return $this;
    }

    /**
     * @param bool $includeSeparatorLine
     *
     * @return Writer
     */
    public function setIncludeSeparatorLine(bool $includeSeparatorLine)
    {
        $this->includeSeparatorLine = $includeSeparatorLine;

        return $this;
    }

    /**
     * @param bool $excelCompatibility
     *
     * @return Writer
     */
    public function setExcelCompatibility(bool $excelCompatibility)
    {
        $this->excelCompatibility = $excelCompatibility;

        return $this;
    }

    /**
     * @return Spreadsheet
     */
    public function getDelegate()
    {
        return $this->spreadsheet;
    }

    /**
     * @return string
     */
    public function tempFile(): string
    {
        return $this->tmpPath . DIRECTORY_SEPARATOR . 'laravel-excel-' . str_random(16);
    }

    /**
     * @param int $sheetIndex
     *
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @return Sheet
     */
    public function getSheetByIndex(int $sheetIndex)
    {
        return new Sheet($this->getDelegate()->getSheet($sheetIndex));
    }

    /**
     * @param array $config
     */
    public function applyCsvSettings(array $config)
    {
        $this->delimiter            = array_get($config, 'delimiter', $this->delimiter);
        $this->enclosure            = array_get($config, 'enclosure', $this->enclosure);
        $this->lineEnding           = array_get($config, 'line_ending', $this->lineEnding);
        $this->useBom               = array_get($config, 'use_bom', $this->useBom);
        $this->includeSeparatorLine = array_get($config, 'include_separator_line', $this->includeSeparatorLine);
        $this->excelCompatibility   = array_get($config, 'excel_compatibility', $this->excelCompatibility);
    }

    /**
     * @param string $concern
     *
     * @return bool
     */
    public function hasConcern($concern): bool
    {
        return $this->exportable instanceof $concern;
    }
}
