<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Route;

trait commandOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupcommandRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/command', [
            'as'        => $routeName.'.command',
            'uses'      => $controller.'@command',
            'operation' => 'command',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupcommandDefaults()
    {
        $this->crud->allowAccess('command');

        $this->crud->operation('command', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            // $this->crud->addButton('top', 'command', 'view', 'crud::buttons.command');
            // $this->crud->addButton('line', 'command', 'view', 'crud::buttons.command');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function command()
    {
        $this->crud->hasAccessOrFail('command');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? 'command '.$this->crud->entity_name;

        // load the view
        return view("crud::operations.command", $this->data);
    }
}
