<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BookingExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Booking::with(['user','film','studio','kursis']);

        // Filter tanggal
        if (!empty($this->filters['tanggal'])) {
            $query->whereDate('tanggal_booking', $this->filters['tanggal']);
        }

        // Filter status bayar
        if (!empty($this->filters['status_bayar'])) {
            $query->where('status_bayar', $this->filters['status_bayar']);
        }

        // Filter status booking
        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        return $query->latest()->get()->map(function($b, $i) {
                return [
                    'No'           => $i + 1,
                    'Kode Booking' => $b->kode_booking,
                    'Pengguna'     => $b->user->name,
                    'Email'        => $b->user->email,
                    'Film'         => $b->film->judul,
                    'Studio'       => $b->studio->nama ?? '-',
                    'Tanggal'      => $b->tanggal_booking,
                    'Jam'          => substr($b->jam_booking, 0, 5),
                    'Kursi'        => $b->kursis->pluck('nomor_kursi')->join(', '),
                    'Jumlah Tiket' => $b->jumlah_tiket,
                    'Total Harga'  => 'Rp '.number_format($b->total_harga),
                    'Metode Bayar' => $b->metode_bayar ?? '-',
                    'Status Bayar' => $b->status_bayar,
                    'Status'       => $b->status,
                    'Tanggal Booking' => $b->created_at->format('d-m-Y H:i'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'No', 'Kode Booking', 'Pengguna', 'Email', 'Film', 'Studio',
            'Tanggal', 'Jam', 'Kursi', 'Jumlah Tiket', 'Total Harga',
            'Metode Bayar', 'Status Bayar', 'Status', 'Tanggal Booking'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1A237E']],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,  'B' => 20, 'C' => 20, 'D' => 25,
            'E' => 25, 'F' => 15, 'G' => 12, 'H' => 8,
            'I' => 15, 'J' => 12, 'K' => 15, 'L' => 15,
            'M' => 20, 'N' => 12, 'O' => 20,
        ];
    }
}