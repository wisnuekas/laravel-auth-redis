<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i=1; $i<=25; $i++) {
            Employee::create([
                'employee_id' => 'EMP'.sprintf('%03d', $i),
                'name' => $faker->name,
                'address' => $faker->address
            ]);
        }
    }
}
