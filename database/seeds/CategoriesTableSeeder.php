<?php

use Illuminate\Database\Seeder;
<<<<<<< 2d558dd78efae0e45033e0f04373ce6ae0982182
use TCG\Voyager\Models\Category;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;
=======
use App\Category;
use Carbon\Carbon;
>>>>>>> searchproduct

class CategoriesTableSeeder extends Seeder
{
    /**
<<<<<<< 2d558dd78efae0e45033e0f04373ce6ae0982182
     * Auto generated seed file.
=======
     * Run the database seeds.
>>>>>>> searchproduct
     *
     * @return void
     */
    public function run()
    {
<<<<<<< 2d558dd78efae0e45033e0f04373ce6ae0982182
        //Data Type
        $dataType = $this->dataType('name', 'categories');
        if (!$dataType->exists) {
            $dataType->fill([
                'slug'                  => 'categories',
                'display_name_singular' => __('voyager::seeders.data_types.category.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.category.plural'),
                'icon'                  => 'voyager-categories',
                'model_name'            => 'TCG\\Voyager\\Models\\Category',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
        //Data Rows
        $categoryDataType = DataType::where('slug', 'categories')->firstOrFail();
        $dataRow = $this->dataRow($categoryDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'parent_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => __('voyager::seeders.data_rows.parent'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'default' => '',
                    'null'    => '',
                    'options' => [
                        '' => '-- None --',
                    ],
                    'relationship' => [
                        'key'   => 'id',
                        'label' => 'name',
                    ],
                ]),
                'order' => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'order');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.order'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'default' => 1,
                ]),
                'order' => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'slug');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.slug'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'slugify' => [
                        'origin' => 'name',
                    ],
                ]),
                'order' => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($categoryDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }

        //Menu Item
        $menu = Menu::where('name', 'admin')->firstOrFail();
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.categories'),
            'url'     => '',
            'route'   => 'voyager.categories.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-categories',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 8,
            ])->save();
        }

        //Permissions
        Permission::generateFor('categories');

        //Content
        $category = Category::firstOrNew([
            'slug' => 'category-1',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name' => 'Category 1',
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug' => 'category-2',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name' => 'Category 2',
            ])->save();
        }
    }

    /**
     * [dataRow description].
     *
     * @param [type] $type  [description]
     * @param [type] $field [description]
     *
     * @return [type] [description]
     */
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
                'data_type_id' => $type->id,
                'field'        => $field,
            ]);
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
=======
        //
        $now = Carbon::now()->toDateTimeString();
       Category::insert([
  ['name' => 'Laptops', 'slug' => 'laptops', 'created_at' => $now, 'updated_at' => $now],
  ['name' => 'Desktops', 'slug' => 'desktops', 'created_at' => $now, 'updated_at' => $now],
  ['name' => 'Mobile Phones', 'slug' => 'mobile-phones', 'created_at' => $now, 'updated_at' => $now],
  ['name' => 'Tablets', 'slug' => 'tablets', 'created_at' => $now, 'updated_at' => $now],
  ['name' => 'TVs', 'slug' => 'tvs', 'created_at' => $now, 'updated_at' => $now],
  ['name' => 'Digital Cameras', 'slug' => 'digital-cameras', 'created_at' => $now, 'updated_at' => $now],
  ['name' => 'Appliances', 'slug' => 'appliances', 'created_at' => $now, 'updated_at' => $now],
]);
>>>>>>> searchproduct
    }
}
