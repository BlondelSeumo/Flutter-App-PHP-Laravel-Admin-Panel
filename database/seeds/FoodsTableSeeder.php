<?php

use Illuminate\Database\Seeder;

class FoodsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('foods')->delete();

        factory(\App\Models\Food::class,30)->create();
        
//        \DB::table('foods')->insert(array (
//            0 =>
//            array (
//                'id' => 1,
//                'name' => 'American fried rice',
//                'price' => 11.0,
//                'discount_price' => 0.0,
//                'description' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\\'s standard dummy text ever since the 1500s<br></p>',
//                'ingredients' => '<p>Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br></p>',
//                'capacity' => 193.0,
//                'featured' => 1,
//                'restaurant_id' => 2,
//                'category_id' => 1,
//                'created_at' => '2019-08-30 12:21:43',
//                'updated_at' => '2019-09-03 22:58:30',
//            ),
//            1 =>
//            array (
//                'id' => 2,
//                'name' => 'Calas',
//                'price' => 15.0,
//                'discount_price' => 0.0,
//                'description' => 'Calas are dumplings composed primarily of cooked rice, yeast, sugar, eggs, and flour; the resulting batter is deep-fried. It is traditionally a breakfast dish, served with coffee or cafe au lait, and has a mention in most Creole cuisine cookbooks.',
//                'ingredients' => 'some ingredients',
//                'capacity' => 634.0,
//                'featured' => 1,
//                'restaurant_id' => 1,
//                'category_id' => 1,
//                'created_at' => '2019-08-31 13:03:37',
//                'updated_at' => '2019-08-31 13:36:16',
//            ),
//            2 =>
//            array (
//                'id' => 3,
//                'name' => 'Pizza Margherita',
//                'price' => 8.0,
//                'discount_price' => 0.0,
//                'description' => 'Tomato sauce, Firm mozzarella cheese, grated. Fresh soft mozzarella cheese, separated into small clumps. Fontina cheese, grated. Parmesan cheese, grated.',
//                'ingredients' => 'Tomato sauce, Firm mozzarella cheese, grated. Fresh soft mozzarella cheese, separated into small clumps. Fontina cheese, grated. Parmesan cheese, grated.',
//                'capacity' => 200.0,
//                'featured' => 1,
//                'restaurant_id' => 1,
//                'category_id' => 1,
//                'created_at' => '2019-10-17 23:06:51',
//                'updated_at' => '2019-10-17 23:06:51',
//            ),
//            3 =>
//            array (
//                'id' => 4,
//                'name' => 'Pizza Montanara',
//                'price' => 6.2,
//                'discount_price' => 0.0,
//            'description' => '<p>Tomato sauce, mozzarella, mushrooms, pepperoni, and Stracchino (soft cheese)<br></p>',
//            'ingredients' => '<p>Tomato sauce, mozzarella, mushrooms, pepperoni, and Stracchino (soft cheese)</p>',
//                'capacity' => 290.5,
//                'featured' => 0,
//                'restaurant_id' => 1,
//                'category_id' => 1,
//                'created_at' => '2019-10-18 10:09:53',
//                'updated_at' => '2019-10-18 10:12:15',
//            ),
//            4 =>
//            array (
//                'id' => 5,
//                'name' => 'Pizza Valtellina',
//                'price' => 7.4,
//                'discount_price' => 0.0,
//                'description' => 'Tomato sauce, mozzarella, bresaola, Parmesan flakes and rocket',
//                'ingredients' => 'Tomato sauce, mozzarella, bresaola, Parmesan flakes and rocket',
//                'capacity' => 245.3,
//                'featured' => 0,
//                'restaurant_id' => 2,
//                'category_id' => 1,
//                'created_at' => '2019-10-18 10:15:19',
//                'updated_at' => '2019-10-18 10:15:19',
//            ),
//            5 =>
//            array (
//                'id' => 6,
//                'name' => 'Pizza al Pesto',
//                'price' => 4.8,
//                'discount_price' => 0.0,
//                'description' => '<p>Tomato, mozzarella, Genoese pesto, pine nuts, and olives<br></p>',
//                'ingredients' => '<p>Tomato, mozzarella, Genoese pesto, pine nuts, and olives<br></p>',
//                'capacity' => 240.0,
//                'featured' => 0,
//                'restaurant_id' => 3,
//                'category_id' => 1,
//                'created_at' => '2019-10-18 10:16:17',
//                'updated_at' => '2019-10-18 10:16:17',
//            ),
//            6 =>
//            array (
//                'id' => 7,
//                'name' => 'Angel Hair',
//                'price' => 10.99,
//                'discount_price' => 8.0,
//                'description' => 'Angel hair is the thinnest type of pasta, made of long, very fine strands that cook quickly. Use delicate sauces with this narrow noodle, like a light tomato sauce or a broth, or simply cook it with butter and oil.',
//                'ingredients' => 'Angel hair is the thinnest type of pasta, made of long, very fine strands that cook quickly. Use delicate sauces with this narrow noodle, like a light tomato sauce or a broth, or simply cook it with butter and oil.',
//                'capacity' => 320.0,
//                'featured' => 1,
//                'restaurant_id' => 3,
//                'category_id' => 3,
//                'created_at' => '2019-10-18 10:19:33',
//                'updated_at' => '2019-10-18 10:19:33',
//            ),
//            7 =>
//            array (
//                'id' => 8,
//                'name' => 'Acini di Pepe',
//                'price' => 11.99,
//                'discount_price' => 9.99,
//                'description' => 'Sometimes referred to as pastina, acini di pepe means “small parts of the pepper” in Italian, alluding to its miniscule size and rounded shape, which makes it versatile enough to be welcome in a wide range of dishes. Make it the mainstay of a cold salad or sprinkle it into a piping hot soup.',
//                'ingredients' => 'Sometimes referred to as pastina, acini di pepe means “small parts of the pepper” in Italian, alluding to its miniscule size and rounded shape, which makes it versatile enough to be welcome in a wide range of dishes. Make it the mainstay of a cold salad o',
//                'capacity' => 260.0,
//                'featured' => 1,
//                'restaurant_id' => 4,
//                'category_id' => 3,
//                'created_at' => '2019-10-18 10:36:17',
//                'updated_at' => '2019-10-18 10:36:17',
//            ),
//            8 =>
//            array (
//                'id' => 9,
//                'name' => 'Pasta Pappardelle',
//                'price' => 12.99,
//                'discount_price' => 10.99,
//                'description' => 'A wide egg noodle with Tuscan origins, pappardelle is often served with hearty meat sauces, as in our decadent bolognese recipe.',
//                'ingredients' => 'A wide egg noodle with Tuscan origins, pappardelle is often served with hearty meat sauces, as in our decadent bolognese recipe.',
//                'capacity' => 290.0,
//                'featured' => 0,
//                'restaurant_id' => 4,
//                'category_id' => 3,
//                'created_at' => '2019-10-18 10:47:46',
//                'updated_at' => '2019-10-18 10:47:46',
//            ),
//            9 =>
//            array (
//                'id' => 10,
//                'name' => 'Pasta Campanelle',
//                'price' => 13.99,
//                'discount_price' => 11.99,
//                'description' => 'Literally meaning “bellflowers,” campanelle sports a very unique shape that’s great at capturing thick, creamy, or meaty sauces. And they work wonders in cheesy bowls, too.',
//                'ingredients' => 'Literally meaning “bellflowers,” campanelle sports a very unique shape that’s great at capturing thick, creamy, or meaty sauces. And they work wonders in cheesy bowls, too.',
//                'capacity' => 190.0,
//                'featured' => 1,
//                'restaurant_id' => 3,
//                'category_id' => 3,
//                'created_at' => '2019-10-18 10:49:08',
//                'updated_at' => '2019-10-18 10:49:08',
//            ),
//            10 =>
//            array (
//                'id' => 11,
//                'name' => 'Chicken Noodle Soup',
//                'price' => 7.9,
//                'discount_price' => 0.0,
//                'description' => 'This creamy cheese soup is delicious on a cold winter day!',
//                'ingredients' => '1/4 cup butter1 onion, chopped 1/4 cup all-purpose flour 3 cups chicken broth 3 cups milk 1 pound shredded Cheddar cheese Add all ingredients to list',
//                'capacity' => 180.0,
//                'featured' => 1,
//                'restaurant_id' => 1,
//                'category_id' => 3,
//                'created_at' => '2019-10-18 10:52:28',
//                'updated_at' => '2019-10-18 10:52:28',
//            ),
//            11 =>
//            array (
//                'id' => 12,
//                'name' => 'California Italian Wedding Soup',
//                'price' => 8.6,
//                'discount_price' => 0.0,
//                'description' => 'This is my variation of a standard recipe. I like fresh basil and a little lemon rind, so those are basically my only changes. This is a quick and easy soup with flavors that impress all.',
//            'ingredients' => '1/2 pound extra-lean ground beef1 egg, lightly beaten 2 tablespoons Italian-seasoned breadcrumbs1 tablespoon grated Parmesan cheese 2 tablespoons shredded fresh basil leaves1 tablespoon chopped Italian flat leaf parsley (extraal) 2 green onions, sliced (',
//                'capacity' => 170.0,
//                'featured' => 1,
//                'restaurant_id' => 3,
//                'category_id' => 3,
//                'created_at' => '2019-10-18 10:54:32',
//                'updated_at' => '2019-10-18 10:54:32',
//            ),
//            12 =>
//            array (
//                'id' => 13,
//                'name' => 'Italian Sausage Soup',
//                'price' => 9.99,
//                'discount_price' => 7.89,
//                'description' => 'This soup embodies all the wonders of Italian cooking: Italian sausage, garlic, tomatoes and red wines. Serve with hot bread and salad for a delicious meal. Garnish with Parmesan cheese.',
//                'ingredients' => '1 pound sweet Italian sausage, casings removed1 cup chopped onion2 cloves garlic, minced5 cups beef broth1/2 cup water 1/2 cup red wine4 large tomatoes - peeled, seeded and chopped1 cup thinly sliced carrots1/2 tablespoon packed fresh basil leaves1/2 teas',
//                'capacity' => 150.0,
//                'featured' => 1,
//                'restaurant_id' => 2,
//                'category_id' => 3,
//                'created_at' => '2019-10-18 10:57:54',
//                'updated_at' => '2019-10-18 10:57:54',
//            ),
//            13 =>
//            array (
//                'id' => 14,
//                'name' => 'Big Smokey Burgers',
//                'price' => 7.99,
//                'discount_price' => 0.0,
//                'description' => '<p>I created this recipe while trying to recreate the best burger I had ever tasted at a restaurant in the Great Smoky Mountains of North Carolina. My family and I think these burgers are better! They are packed with flavor!<br></p>',
//                'ingredients' => '<ul><li>2 pounds ground beef sirloin</li><li>1/2 onion, grated1 tablespoon grill seasoning</li><li>1 tablespoon liquid smoke flavoring </li><li>2 tablespoons Worcestershire sauce </li><li>2 tablespoons minced garlic</li><li>1 table</li></ul>',
//                'capacity' => 150.0,
//                'featured' => 1,
//                'restaurant_id' => 2,
//                'category_id' => 2,
//                'created_at' => '2019-10-18 11:01:09',
//                'updated_at' => '2019-10-18 11:46:40',
//            ),
//            14 =>
//            array (
//                'id' => 15,
//                'name' => 'Juicy Lucy Burgers',
//                'price' => 8.99,
//                'discount_price' => 0.0,
//                'description' => '<p>A favorite of Minnesotans! The famous Juicy Lucy! Mmmm. So good. You MUST use American cheese on this to achieve the juiciness in the middle! I like sauteed mushrooms and onions on mine!<br></p>',
//                'ingredients' => '<ul><li><span style="font-size: 1rem;">1/2 pounds ground beef</span></li><li><span style="font-size: 1rem;">1 tablespoon Worcestershire sauce</span></li><li><span style="font-size: 1rem;">3/4 teaspoon garlic salt</span></li><li><span style="font-size: 1re',
//                'capacity' => 190.0,
//                'featured' => 1,
//                'restaurant_id' => 4,
//                'category_id' => 2,
//                'created_at' => '2019-10-18 11:49:36',
//                'updated_at' => '2019-10-18 11:49:36',
//            ),
//            15 =>
//            array (
//                'id' => 16,
//                'name' => 'Cedar Planked Salmon',
//                'price' => 16.3,
//                'discount_price' => 12.9,
//                'description' => '<p>This is a dish my brother prepared for me in Seattle. It is by far the best salmon I\'ve ever eaten. I like to serve it with Asian-inspired rice and roasted asparagus.<br></p>',
//            'ingredients' => '<ul><li>3 (12 inch) untreated cedar planks</li><li>1/3 cup vegetable oil</li><li>1/2 tablespoons rice vinegar1 teaspoon sesame oil</li><li>1/3 cup soy sauce</li><li>1/4 cup chopped green onions</li><li>1 tablespoon grated fresh ginger root</li><li>1 teasp',
//                'capacity' => 163.0,
//                'featured' => 1,
//                'restaurant_id' => 3,
//                'category_id' => 1,
//                'created_at' => '2019-10-18 11:51:51',
//                'updated_at' => '2019-10-18 11:51:51',
//            ),
//        ));
        
        
    }
}