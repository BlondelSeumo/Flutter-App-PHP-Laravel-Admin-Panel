<?php

use Illuminate\Database\Seeder;

class CuisinesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('cuisines')->delete();
        
        \DB::table('cuisines')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Chinese',
                'description' => 'Eum similique maiores atque quia explicabo. Dolores quia placeat consequatur id quis perspiciatis. Ducimus sit ducimus officia labore maiores et porro. Est iusto natus nesciunt debitis consequuntur totam. Et illo et autem inventore earum corrupti.',
                'created_at' => '2020-04-11 15:03:21',
                'updated_at' => '2020-04-11 15:03:21',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Indian',
                'description' => 'Eaque et aut natus. Minima blanditiis ut sunt distinctio ad. Quasi doloremque rerum ex rerum. Molestias similique similique aut rerum delectus blanditiis et. Dolorem et quas nostrum est nobis.',
                'created_at' => '2020-04-11 15:03:21',
                'updated_at' => '2020-04-11 15:03:21',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Thai',
                'description' => 'Est nihil omnis natus ducimus ducimus excepturi quos. Et praesentium in quia veniam. Tempore aut nesciunt consequatur pariatur recusandae. Voluptatem commodi eius quaerat est deleniti impedit. Qui quo harum est sequi incidunt labore eligendi cum.',
                'created_at' => '2020-04-11 15:03:21',
                'updated_at' => '2020-04-11 15:03:21',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Greek',
                'description' => 'Ex nostrum suscipit aut et labore. Ut dolor ut eum eum voluptatem ex. Sapiente in tempora soluta voluptatem. Officia accusantium quae sit. Rerum esse ipsa molestias dolorem et est autem consequatur.',
                'created_at' => '2020-04-11 15:03:21',
                'updated_at' => '2020-04-11 15:03:21',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Vietnamese',
                'description' => 'Dolorum earum ut blanditiis blanditiis. Facere quis voluptates assumenda saepe. Ab aspernatur voluptatibus rem doloremque cum impedit. Itaque blanditiis commodi repudiandae asperiores. Modi atque placeat consectetur et aut blanditiis.',
                'created_at' => '2020-04-11 15:03:21',
                'updated_at' => '2020-04-11 15:03:21',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'French',
                'description' => 'Est et iste enim. Quam repudiandae commodi rerum non esse. Et in aut sequi est aspernatur. Facere non modi expedita asperiores. Ipsa laborum saepe deserunt qui consequatur voluptas inventore dolorum.',
                'created_at' => '2020-04-11 15:03:21',
                'updated_at' => '2020-04-11 15:03:21',
            ),
        ));
        
        
    }
}