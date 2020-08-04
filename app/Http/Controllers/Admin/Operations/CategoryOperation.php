<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Route;

trait CategoryOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupCategoryRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/category', [
            'as'        => $routeName.'.category',
            'uses'      => $controller.'@category',
            'operation' => 'category',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupCategoryDefaults()
    {
        $this->crud->allowAccess('category');

        $this->crud->operation('category', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            // $this->crud->addButton('top', 'category', 'view', 'crud::buttons.category');
            $this->crud->addButton('line', 'category', 'view', 'crud::buttons.category');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function category()
    {
        $this->crud->hasAccessOrFail('category');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? 'category '.$this->crud->entity_name;

        // load the view
        return view("crud::operations.category", $this->data);
    }
}
