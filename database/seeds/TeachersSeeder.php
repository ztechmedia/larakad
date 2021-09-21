<?php

use Illuminate\Database\Seeder;
use App\Models\Level;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sma = new Level();
        $sma->name = 'Sekolah Menengah Atas';
        $sma->stand_for = 'SMA';
        $sma->save();

        $smp = new Level();
        $smp->name = 'Sekolah Menengah Pertama';
        $smp->stand_for = 'SMP';
        $smp->save();

        $sd = new Level();
        $sd->name = 'Sekolah Dasar';
        $sd->stand_for = 'SD';
        $sd->save();
    }
}
