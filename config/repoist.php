<?php

return [
     


    'path' => 'Repositories',
     /**
     * Default path of models in laravel is the `app` folder.
     * In this case:
     *      app/
     */
    'model_path' => 'Models',
    /**
     * Namespaces are being prefixed with the applications base namespace.
     */

    'namespaces' => [
        'contracts'    => 'Repositories\Contracts',
        'repositories' => 'Repositories\Eloquent',
    ],

    /**
     * Paths will be used with the `app()->basePath().'/app/'` function to reach app directory.
     */
    'paths' => [
        'contracts'    => 'Repositories/Contracts/',
        'repositories' => 'Repositories/Eloquent/',
    ],

];
