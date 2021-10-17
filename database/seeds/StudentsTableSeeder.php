<?php

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use App\Models\Role;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student = new Student();
        $student->nis = '123123';
        $student->nisn = '123123';
        $student->name = 'Ariel';
        $student->gender = 'L';
        $student->birth_place = 'Bekasi';
        $student->birth_date = '2015-09-28';
        $student->status = 'Anak Kandung';
        $student->child_position = '1';
        $student->address = 'Jl. KH. Agus Salim No.8 RT06/RW08 Bekasi Jaya Bekasi Timue 17112';
        $student->mobile = '089517227009';
        $student->school_origin = '-';
        $student->join_at_class = '1';
        $student->join_date = '2021-06-01';
        $student->father_name = 'Ari Laso';
        $student->mother_name = 'Luna Maya';
        $student->parent_address = 'Jl. KH. Agus Salim No.8 RT06/RW08 Bekasi Jaya Bekasi Timue 17112';
        $student->parent_mobile = '089517227008';
        $student->father_job = 'Wirausaha';
        $student->mother_job = 'IRT';
        $student->created_by = 'migrations';

        $role = Role::where("name", 'student')->first();
        $dataUser = [
            'name' => $student->name,
            'email' => 'ariel@gmail.com',
            'password' => bcrypt('12345678')
        ];
        $user = User::create($dataUser);
        $user->attachRole($role);

        $student->level_id = '3';
        $student->user_id = $user->id;
        $student->save();
    }
}
