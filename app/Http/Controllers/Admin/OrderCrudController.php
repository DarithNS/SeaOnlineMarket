<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OrderCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Order::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/order');
        CRUD::setEntityNameStrings('order', 'orders');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name'      => 'product_id',
            'label'     => 'Product',
            'type'      => 'select',
            'entity'    => 'product',
            'attribute' => 'name',
            'model'     => 'App\Models\Product',
        ]);
        $this->crud->addColumn([
            'name'      => 'customer_id',
            'label'     => 'Customer',
            'type'      => 'select',
            'entity'    => 'customer',
            'attribute' => 'name',
            'model'     => 'App\Models\Customer',
        ]);
        $this->crud->addColumn([
            'name'      => 'payment_id',
            'label'     => 'Payment Type',
            'type'      => 'select',
            'entity'    => 'payment',
            'attribute' => 'payment_name',
            'model'     => 'App\Models\Payment',
        ]);
        CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(OrderRequest::class);

        $this->crud->addField([
            'name'      => 'product_id',
            'label'     => 'Product',
            'type'      => 'select2',
            'entity'    => 'product',
            'attribute' => 'name',
            'model'     => 'App\Models\Product',
        ]);

        $this->crud->addField([
            'name'      => 'customer_id',
            'label'     => 'Customer',
            'type'      => 'select2',
            'entity'    => 'customer',
            'attribute' => 'name',
            'model'     => 'App\Models\Customer',
        ]);

        $this->crud->addField([
            'name'      => 'payment_id',
            'label'     => 'Payment',
            'type'      => 'select2',
            'entity'    => 'payment',
            'attribute' => 'payment_name',
            'model'     => 'App\Models\Payment',
        ]);

        $this->crud->addField([
            'name'      => 'order_date_time',
            'label'     => 'Date Time',
            'type'      => 'datetime',
        ]);
        CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
