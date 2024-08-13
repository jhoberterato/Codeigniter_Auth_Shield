<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $builder = $this->db->table("students");

        $builder->insert([
            "name" => "Nicko Cambarihan",
            "email" => "nickocambarihan@gmail.com",
            "phone" => "99999999999",
        ]); //Instead of this use below to insert dummy datas

        for($i = 0; $i < 100; $i++){
            $builder->insert($this->generateStudents());
        }
    }

    public function generateStudents()
    {
        $faker = Factory::create();
        return [
            "name" => $faker->name,
            "email" => $faker->email,
            "phone" => $faker->phoneNumber,
        ];
    }
}
