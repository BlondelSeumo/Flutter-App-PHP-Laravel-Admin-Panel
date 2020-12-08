<?php

namespace Tests\Browser;

use App\Models\Store;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
//    /**
//     * A basic browser test example.
//     *
//     * @return void
//     * @throws \Throwable
//     */
//    public function testBasicExample()
//    {
//        $this->browse(function (Browser $browser) {
//            $browser->visit('/')
//                    ->assertSee('Laravel');
//        });
//    }

    /**
     * @throws \Throwable
     */
    public function testMenus()
    {
        $this->browse(function (Browser $browser){
            // $browser->pause(3000);
            $browser->visit('/menus')
                ->assertSee('Menus Management')
                ->assertPresent('.dataTable');
//            $browser->click('div.card-header a');

            $browser->visit('/menus/create')
                ->assertSelectHasOptions('store_id',Store::pluck('id')->toArray());

            $browser->visit('/menus/1/edit')
                ->assertSelectHasOptions('store_id',Store::pluck('id')->toArray());
        });
    }
}
