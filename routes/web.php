<?php

Route::group(['middleware' => 'web', 'prefix' => 'customfields', 'namespace' => 'Jano\\Modules\CustomFields\Http\Controllers'], function()
{
    Route::get('/', 'CustomFieldsController@index');
});
