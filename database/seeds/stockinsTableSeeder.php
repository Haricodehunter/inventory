<?php

use Illuminate\Database\Seeder;

class stockinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        stockin::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            stockin::create([
                'lotname' => $faker->lotname,
                'note' => $faker->note,
                'image' => $faker->image,
                'approvaldate' => $faker->approvaldate,
                'approved' => $faker->approved,
                'approvedby' => $faker->approvedby,
                'categoryid' => $faker->categoryid,
                'subcategoryid' => $faker->subcategoryid,
                'buildingname' => $faker->buildingname,
                'uniqtag' => $faker->uniqtag,
            ]);
        }
    }
}
