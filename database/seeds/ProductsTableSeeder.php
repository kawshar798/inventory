<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('products')->delete();

        \DB::table('products')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Medium sicily bag in aria matelassé calfskin',
                'type' => NULL,
                'description' => '<p>An icon of the brand for excellence, the medium sized Sicily bag is offered in aria matelass&eacute; calfskin for the FW20. Versatile and feminine, it unites both practicality and elegance:<br />&bull; Front flap with hidden press-stud closure<br />&bull; Logoed bigalvanic plate<br />&bull; On top handle with removable and adjustable aria calfskin strap<br />&bull; Printed fabric lining<br />&bull; Internal pocket with logoed zipper and smartphone pocket<br />&bull; Metal bag feet on the base<br />&bull; Item is equipped with a themed and logoed dust bag<br />&bull; Measurements: 26 x 21 x 12cm - 10 x 8 x 4.7 inches<br />&bull; Made in Italy</p>',
                'unit_id' => 1,
                'brand_id' => 1,
                'category_id' => 1,
                'sub_category_id' => 3,
                'tax' => NULL,
                'tax_type' => NULL,
                'quantity' => 100,
                'alert_quantity' => 10,
                'sku' => '1236',
                'image' => 'public/images/product/medium-sicily-bag-in-aria-matelasse-calfskin-1599708586.jpg',
                'cost_price' => 300.0,
                'mrp' => 380.0,
                'featured' => 0,
                'barcode' => '10053362',
                'barcode_symbology' => 'C128',
                'status' => 'Active',
                'created_at' => '2020-09-10 03:29:46',
                'updated_at' => '2020-09-10 03:29:46',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Medium Sicily Bag In Aria Matelassé Calfskin2',
                'type' => NULL,
                'description' => '<p>An icon of the brand for excellence, the medium sized Sicily bag is offered in aria matelass&eacute; calfskin for the FW20, in shades that are pair perfectly with the &ldquo;In the wood&rdquo; theme. Versatile and feminine, it unites both practicality and elegance:<br />&bull; Front flap with hidden press-stud closure<br />&bull; Logoed bigalvanic plate<br />&bull; On top handle with removable and adjustable aria calfskin strap<br />&bull; Printed fabric lining<br />&bull; Internal pocket with logoed zipper and smartphone pocket<br />&bull; Metal bag feet on the base<br />&bull; Item is equipped with a themed and logoed dust bag<br />&bull; Measurements: 26 x 21 x 12cm - 10 x 8 x 4.7 inches<br />&bull; Made in Italy</p>',
                'unit_id' => 1,
                'brand_id' => 1,
                'category_id' => 1,
                'sub_category_id' => 3,
                'tax' => NULL,
                'tax_type' => NULL,
                'quantity' => 123,
                'alert_quantity' => 10,
                'sku' => '23212',
                'image' => 'public/images/product/medium-sicily-bag-in-aria-matelasse-calfskin-1599708712.jpg',
                'cost_price' => 380.0,
                'mrp' => 500.0,
                'featured' => 0,
                'barcode' => '10030862',
                'barcode_symbology' => 'C128',
                'status' => 'Active',
                'created_at' => '2020-09-10 03:31:52',
                'updated_at' => '2020-09-10 03:31:52',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Medium Sicily Bag In Aria Matelassé Calfskin3',
                'type' => NULL,
                'description' => '<p>An icon of the brand for excellence, the medium sized Sicily bag is offered in aria matelass&eacute; calfskin for the FW20. Versatile and feminine, it unites both practicality and elegance:<br />&bull; Front flap with hidden press-stud closure<br />&bull; Logoed bigalvanic plate<br />&bull; On top handle with removable and adjustable aria calfskin strap<br />&bull; Printed fabric lining<br />&bull; Internal pocket with logoed zipper and smartphone pocket<br />&bull; Metal bag feet on the base<br />&bull; Item is equipped with a themed and logoed dust bag<br />&bull; Measurements: 26 x 21 x 12cm - 10 x 8 x 4.7 inches<br />&bull; Made in Italy</p>',
                'unit_id' => 1,
                'brand_id' => 1,
                'category_id' => 1,
                'sub_category_id' => 3,
                'tax' => NULL,
                'tax_type' => NULL,
                'quantity' => 50,
                'alert_quantity' => 10,
                'sku' => '4353',
                'image' => 'public/images/product/medium-sicily-bag-in-aria-matelasse-calfskin-1599708864.jpg',
                'cost_price' => 300.0,
                'mrp' => 400.0,
                'featured' => 0,
                'barcode' => '10031639',
                'barcode_symbology' => 'C128',
                'status' => 'Active',
                'created_at' => '2020-09-10 03:34:24',
                'updated_at' => '2020-09-10 03:34:24',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Small Dg Girls In Calfskin',
                'type' => NULL,
                'description' => '<p>The DG Girls line enriches every season with new models. The new small sized handbag is made of smooth calfskin and presents a semi-soft ribbed construction. It features bezels that turn on the bottom of the bag. It stands out thanks to the baroque DG logo on the front in metallized ABS:<br />&bull; On top calfskin handles with chain attachments<br />&bull; On top closure with flap and hidden magnet<br />&bull; Adjustable and removable calfskin strap<br />&bull; Calfskin lining<br />&bull; Item is equipped with a themed and logoed dust bag<br />&bull; Measurement: 18 x 15 x 8cm - 7 x 5.9 x 3 inches<br />&bull; Made in Ita</p>',
                'unit_id' => 1,
                'brand_id' => 1,
                'category_id' => 1,
                'sub_category_id' => 3,
                'tax' => NULL,
                'tax_type' => NULL,
                'quantity' => 40,
                'alert_quantity' => 10,
                'sku' => '7543',
                'image' => 'public/images/product/small-dg-girls-in-calfskin-1599708948.jpg',
                'cost_price' => 300.0,
                'mrp' => 400.0,
                'featured' => 0,
                'barcode' => '10045543',
                'barcode_symbology' => 'C128',
                'status' => 'Active',
                'created_at' => '2020-09-10 03:35:48',
                'updated_at' => '2020-09-10 03:35:48',
            ),
        ));


    }
}
