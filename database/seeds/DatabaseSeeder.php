<?php
/**
 * File name: DatabaseSeeder.php
 * Last modified: 2020.05.03 at 13:40:04
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CustomFieldsTableSeeder::class);
        $this->call(CustomFieldValuesTableSeeder::class);
        $this->call(AppSettingsTableSeeder::class);
        $this->call(CuisinesTableSeeder::class);
        $this->call(RestaurantsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(FaqCategoriesTableSeeder::class);
        $this->call(OrderStatusesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(ExtraGroupsTableSeeder::class);

        $this->call(FoodsTableSeeder::class);
        $this->call(GalleriesTableSeeder::class);
        $this->call(FoodReviewsTableSeeder::class);
        $this->call(RestaurantReviewsTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(DeliveryAddressesTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(CartsTableSeeder::class);
        $this->call(NutritionTableSeeder::class);
        $this->call(ExtrasTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(FaqsTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);

        $this->call(FoodOrdersTableSeeder::class);
        $this->call(CartExtrasTableSeeder::class);
        $this->call(UserRestaurantsTableSeeder::class);
        $this->call(DriverRestaurantsTableSeeder::class);
        $this->call(FoodOrderExtrasTableSeeder::class);
        $this->call(FavoriteExtrasTableSeeder::class);
        $this->call(RestaurantCuisinesTableSeeder::class);

        $this->call(RolesTableSeeder::class);
        $this->call(DemoPermissionsPermissionsTableSeeder::class);
        $this->call(ModelHasPermissionsTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);

        $this->call(MediaTableSeeder::class);
        $this->call(UploadsTableSeeder::class);
        $this->call(DriversTableSeeder::class);
        $this->call(EarningsTableSeeder::class);
        $this->call(DriversPayoutsTableSeeder::class);
        $this->call(RestaurantsPayoutsTableSeeder::class);

        $this->call(CouponPermission::class);
        $this->call(SlidesSeeder::class);
    }

}
