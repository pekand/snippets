<?php

Route::get('/vendor/package/{locale}', 'Main@show')->middleware(['package', 'web']);

