<?php

use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('faqs')->delete();
        factory(\App\Models\Faq::class,30)->create();
//
//        \DB::table('faqs')->insert(array (
//            0 =>
//            array (
//                'id' => 1,
//                'question' => 'Amet aliquam id diam maecenas ultricies mi eget ?',
//                'answer' => 'Tellus cras adipiscing enim eu turpis. Facilisis magna etiam tempor orci eu lobortis. Nibh tellus molestie nunc non. Risus in hendrerit gravida rutrum quisque non tellus orci ac. Sagittis nisl rhoncus mattis rhoncus urna neque viverra justo.',
//                'faq_category_id' => 1,
//                'created_at' => '2019-08-31 12:33:33',
//                'updated_at' => '2019-10-17 23:13:43',
//            ),
//            1 =>
//            array (
//                'id' => 2,
//                'question' => 'Posuere sollicitudin aliquam ultrices?',
//                'answer' => 'Nulla porttitor massa id neque aliquam vestibulum morbi. Sed pulvinar proin gravida hendrerit. Ullamcorper a lacus vestibulum sed arcu non odio euismod.',
//                'faq_category_id' => 2,
//                'created_at' => '2019-09-06 10:27:15',
//                'updated_at' => '2019-10-17 23:14:17',
//            ),
//            2 =>
//            array (
//                'id' => 3,
//                'question' => 'Volutpat blandit aliquam etiam erat velit?',
//                'answer' => 'Nulla porttitor massa id neque aliquam vestibulum morbi. Sed pulvinar proin gravida hendrerit. Ullamcorper a lacus vestibulum sed arcu non odio euismod',
//                'faq_category_id' => 1,
//                'created_at' => '2019-10-17 23:14:56',
//                'updated_at' => '2019-10-17 23:14:56',
//            ),
//            3 =>
//            array (
//                'id' => 4,
//                'question' => '<p>Aliquet porttitor lacus luctus?<br></p>',
//                'answer' => '<p>Eget egestas purus viverra accumsan in nisl nisi. Posuere urna nec tincidunt praesent semper feugiat nibh sed pulvinar. Urna cursus eget nunc scelerisque viverra. Accumsan in nisl nisi scelerisque eu ultrices vitae auctor eu.<br></p>',
//                'faq_category_id' => 1,
//                'created_at' => '2019-10-17 23:16:33',
//                'updated_at' => '2019-10-17 23:16:33',
//            ),
//            4 =>
//            array (
//                'id' => 5,
//                'question' => '<p>Proin fermentum leo vel orci porta non pulvinar ?<br></p>',
//                'answer' => 'Facilisis mauris sit amet massa vitae tortor condimentum lacinia. Arcu dui vivamus arcu felis bibendum ut. Enim facilisis gravida neque convallis a cras semper auctor neque. Pellentesque elit eget gravida cum sociis natoque penatibus et. Massa massa ultricies mi quis. Diam donec adipiscing tristique risus nec feugiat. Id venenatis a condimentum vitae sapien pellentesque habitant morbi. Amet justo donec enim diam vulputate ut.',
//                'faq_category_id' => 2,
//                'created_at' => '2019-10-17 23:17:03',
//                'updated_at' => '2019-10-17 23:17:03',
//            ),
//            5 =>
//            array (
//                'id' => 6,
//                'question' => '<p>Lorem ipsum dolor sit amet<br></p>',
//                'answer' => '<p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis tristique sollicitudin nibh sit amet commodo nulla. Nullam ac tortor vitae purus faucibus ornare. Odio morbi quis commodo odio aenean sed. Sit amet tellus cras adipiscing enim.&nbsp;<br></p>',
//                'faq_category_id' => 2,
//                'created_at' => '2019-10-17 23:17:36',
//                'updated_at' => '2019-10-17 23:17:36',
//            ),
//            6 =>
//            array (
//                'id' => 7,
//                'question' => '<p>Bibendum ut tristique et egestas?<br></p>',
//                'answer' => '<p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis tristique sollicitudin nibh sit amet commodo nulla. Nullam ac tortor vitae purus faucibus ornare. Odio morbi quis commodo odio aenean sed. Sit amet tellus cras adipiscing enim.&nbsp;<br></p>',
//                'faq_category_id' => 3,
//                'created_at' => '2019-10-17 23:18:06',
//                'updated_at' => '2019-10-17 23:18:06',
//            ),
//            7 =>
//            array (
//                'id' => 8,
//                'question' => 'Viverra nam libero justo laoreet',
//                'answer' => '<p>Est placerat in egestas erat imperdiet sed euismod. Non quam lacus suspendisse faucibus interdum posuere lorem. Eget lorem dolor sed viverra ipsum nunc aliquet bibendum enim.<br></p>',
//                'faq_category_id' => 3,
//                'created_at' => '2019-10-17 23:18:32',
//                'updated_at' => '2019-10-17 23:18:32',
//            ),
//            8 =>
//            array (
//                'id' => 9,
//                'question' => 'Amet cursus sit amet dictum sit?',
//                'answer' => 'Est placerat in egestas erat imperdiet sed euismod. Non quam lacus suspendisse faucibus interdum posuere lorem. Eget lorem dolor sed viverra ipsum nunc aliquet bibendum enim.',
//                'faq_category_id' => 4,
//                'created_at' => '2019-10-17 23:19:46',
//                'updated_at' => '2019-10-17 23:19:46',
//            ),
//        ));
        
        
    }
}