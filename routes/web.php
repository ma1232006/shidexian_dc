<?php

Route::get('/', 'HomeController@index');

Route::post('create', 'HomeController@create')->name('create');
