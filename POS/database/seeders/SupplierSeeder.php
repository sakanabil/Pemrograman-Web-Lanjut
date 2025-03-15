<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'supplier_id' => 1,
                'supplier_kode' => 'SUP001',
                'supplier_nama' => 'PT ABC',
                'supplier_alamat' => 'Jl. Merdeka No. 10, Jakarta'
            ],
            [
                'supplier_id' => 2,
                'supplier_kode' => 'SUP002',
                'supplier_nama' => 'PT DEF',
                'supplier_alamat' => 'Jl. Jend. Sudirman No. 20, Surabaya'
            ],
            [
                'supplier_id' => 3,
                'supplier_kode' => 'SUP003',
                'supplier_nama' => 'PT GHI',
                'supplier_alamat' => 'Jl. Diponegoro No. 5, Bandung'
            ],
        ];
        DB::table('m_supplier')->insert($data);
    }
}