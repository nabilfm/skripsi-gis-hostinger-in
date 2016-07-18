<?php

use Illuminate\Database\Seeder;

class SekolahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $sekolah = [
            array(
                'nama'=>  'SMAN 5 Kota Depok',
                'npsn'=>  '20229167',
                'alamat'=>  'JL. PERUM BUKIT RIVARIA SWG',
                'latitude'=>  -6.4106878,
                'longitude'=>  106.759800,
                'kdpos'=>  '16519',
                'kelurahan'=> 'Bedahan' ,
                'kecamatan'=> 'Sawangan' ,
                'kabupaten'=> 'Kota Depok',
                'propinsi'=> 'Jawa Barat' ,
                'status'=> 'Negeri',
                'jenjang'=> 'sma'),

            array(
                'nama'=>  'SMP Negeri 25 Depok',
                'npsn'=>  '69900817',
                'alamat'=>  'jl. Pertiwi Raya Kompleks Bapenas Kedaung',
                'latitude'=>  -6.2354,
                'longitude'=>  106.23202,
                'kdpos'=>  '16516',
                'kelurahan'=> 'Kedaung' ,
                'kecamatan'=> 'Sawangan' ,
                'kabupaten'=> 'Kota Depok',
                'propinsi'=> 'Jawa Barat' ,
                'status'=> 'Negeri',
                'jenjang'=> 'smp'
            )
        ];
        DB::table('sekolah')->insert($sekolah);
    }
}
