<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('skills', function() {
    return ['laravel', 'vue', 'php', 'javascript'];
});

Route::resource('projects', 'ProjectsController');