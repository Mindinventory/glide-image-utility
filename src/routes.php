<?php

Route::group(['namespace' => 'Mi\MiImageUtility'], function () {

    Route::get('/image', 'ImageController@getImage');
});
