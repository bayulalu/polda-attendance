<?php

namespace App\Exports;

use App\Helpers\NumberHelper;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class AttendanceExport implements FromArray, ShouldAutoSize, WithHeadings, WithStyles, WithCustomStartCell, WithEvents
{
    use Exportable;

    private $attendances;
    private $request;

    public function __construct($attendances)
    {
        $this->attendances = $attendances;
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function headings(): array
    {
        $headers = [
            ['No', 'Nama', 'Pangkat'], // Header pertama
            [' ', ' ', ' '], // Kosongkan sub-header untuk No, Nama, Pangkat
        ];

        foreach ($this->attendances[0]['attendances'] as $value) {
            $headers[0][] = $value['date']; // Menambahkan tanggal ke header
            $headers[0][] = ''; // Kosongkan kolom kedua untuk tanggal yang sama
            $headers[0][] = ''; // Kosongkan kolom ketiga untuk tanggal yang sama

            // Menambahkan tiga sub-header untuk setiap tanggal
            $headers[1][] = 'Type'; // Sub-header type
            $headers[1][] = 'Check In'; // Sub-header check_in
            $headers[1][] = 'Check Out'; // Sub-header check_out
        }

        return $headers;
    }


    public function array(): array
    {
        $data = [];

        // Menyiapkan data untuk dimulai dari baris 4
        foreach ($this->attendances as $index => $attendance) {
            $row = [
                $index + 1, // No
                $attendance['name'], // Nama
                $attendance['rank'] ?? null, // Pangkat
            ];

            // Mulai dari kolom D untuk setiap tanggal
            foreach ($attendance['attendances'] as $att) {
                $row[] = $att['type'] ?? 'tanpa keterangan'; // Menambahkan type
                $row[] = $att['check_in'] ?? '-'; // Menambahkan check_in
                $row[] = $att['check_out'] ?? '-'; // Menambahkan check_out
            }

            $data[] = $row; // Menambahkan baris ke array data
        }

        return $data;
    }


    public function styles(Worksheet $sheet)
    {
        // Menggabungkan header untuk No, Nama, Pangkat
        $sheet->mergeCells('A2:A3');
        $sheet->mergeCells('B2:B3');
        $sheet->mergeCells('C2:C3');

        // Menambahkan gaya pada sel yang digabungkan
        $sheet->getStyle('A2:A3')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle('B2:B3')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle('C2:C3')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $startColumnIndex = 4; // Indeks kolom D
        $totalDates = count($this->attendances[0]['attendances']);

        for ($i = 0; $i < $totalDates; $i++) {
            // Menghitung indeks kolom yang akan digabungkan
            $firstColumnIndex = $startColumnIndex + ($i * 3);
            $lastColumnIndex = $firstColumnIndex + 2;

            // Mengonversi indeks kolom menjadi string kolom
            $firstColumn = Coordinate::stringFromColumnIndex($firstColumnIndex);
            $lastColumn = Coordinate::stringFromColumnIndex($lastColumnIndex);

            // Menggabungkan tiga kolom yang berdekatan
            $range = "{$firstColumn}2:{$lastColumn}2";
            $sheet->mergeCells($range);

            // Menambahkan gaya pada sel yang digabungkan
            $sheet->getStyle($range)->applyFromArray([
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ]);
        }

        return [];
    }

    // public function styles(Worksheet $sheet)
    // {

    //     $columns = range('C', chr(ord('C') + count($this->attendances[0]['attendances']) - 1));

    //     // Menggabungkan setiap dua baris berdasarkan tanggal
    //     foreach ($columns as $column) {
    //         // Contoh penggabungan untuk baris 2 dan 3
    //         $sheet->mergeCells($column . '2:' . $column . '3');

    //         // Menambahkan gaya pada sel yang digabungkan
    //         $sheet->getStyle($column . '2:' . $column . '3')->applyFromArray([
    //             'font' => [
    //                 'bold' => true,
    //             ],
    //             'alignment' => [
    //                 'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    //                 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    //             ],
    //         ]);
    //     }
    //     return [];
    //     // $sheet->mergeCells('A2:B2');

    //     // // Optional: Apply styles to merged cells
    //     // $sheet->getStyle('A2:B2')->applyFromArray([
    //     //     'font' => [
    //     //         'bold' => true,
    //     //     ],
    //     //     'alignment' => [
    //     //         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    //     //         'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    //     //     ],
    //     // ]);

    //     // return [
    //     //     // Apply styles to other cells if needed
    //     //     'A2:B2' => [
    //     //         'alignment' => [
    //     //             'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    //     //         ],
    //     //     ],
    //     // ];

    //     // sparke contoh
    //     // $companyName = $this->employeeData[0]->company->name ?? null; 
    //     // $companyLocationName = $this->employeeData[0]->companyLocation->name ?? '-';

    //     // $sheet->setCellValue('A1', 'Company');
    //     // $sheet->setCellValue('A2', 'Office/Branch');
    //     // $sheet->setCellValue('A3', 'Generate Date');
    //     // $sheet->setCellValue('A4', 'Report Type');
    //     // $this->cellcollor($sheet, 'A1:A4');
    //     // $this->cellcollor($sheet, 'B1:B4');
    //     // $this->cellcollor($sheet, 'A6:AD6');
    //     // $sheet->setCellValue('C1', $companyName);
    //     // $sheet->setCellValue('C2', $companyLocationName);
    //     // $sheet->setCellValue('C3', $today->format('d F Y').', '.$today->format('H:i'));
    //     // $sheet->setCellValue('C4', 'Employee List');

    //     // $sheet->getStyle("A1:C4")->applyFromArray(['borders' => [
    //     //     'outline' => [
    //     //         'borderStyle' => Border::BORDER_THIN,
    //     //         'color' => ['argb' => Color::COLOR_BLACK],
    //     //     ],
    //     // ]]);

    //     // $lastrow = 6 + count($this->employeeData);
    //     // $sheet->getStyle("A6:AD{$lastrow}")->applyFromArray(['borders' => [
    //     //         'allBorders' => [
    //     //             'borderStyle' => Border::BORDER_THIN,
    //     //             'color' => ['argb' => Color::COLOR_BLACK],
    //     //         ],
    //     //     ],
    //     //     'alignment' => [
    //     //         'horizontal' => Alignment::HORIZONTAL_LEFT,
    //     //     ],
    //     // ]);
    // }

    // private function cellcollor(&$sheet, $cells, $color = Color::COLOR_BLACK, $textColor = Color::COLOR_WHITE)
    // {
    //     $styleArray = [
    //         // Style the first row as bold text.
    //         'font' => [
    //             'color' => [
    //                 'argb' => $textColor
    //             ],
    //         ],
    //         'fill' => [
    //             'fillType' => Fill::FILL_SOLID,
    //             'startColor' => [
    //                 'argb' => $color,
    //             ],
    //             'endColor' => [
    //                 'argb' => $color,
    //             ],
    //         ],
    //         'borders' => [
    //             'outline' => [
    //                 'color' => ['argb' => Color::COLOR_BLACK],
    //             ],
    //         ],
    //     ];

    //     return $sheet->getStyle($cells)->applyFromArray($styleArray);

    // }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->freezePane('D2');
            },
        ];
    }
}
