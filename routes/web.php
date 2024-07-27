<?php

Route::view('/', 'welcome');
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Habits
    Route::delete('habits/destroy', 'HabitsController@massDestroy')->name('habits.massDestroy');
    Route::post('habits/media', 'HabitsController@storeMedia')->name('habits.storeMedia');
    Route::post('habits/ckmedia', 'HabitsController@storeCKEditorImages')->name('habits.storeCKEditorImages');
    Route::post('habits/parse-csv-import', 'HabitsController@parseCsvImport')->name('habits.parseCsvImport');
    Route::post('habits/process-csv-import', 'HabitsController@processCsvImport')->name('habits.processCsvImport');
    Route::resource('habits', 'HabitsController');

    // Survey
    Route::delete('surveys/destroy', 'SurveyController@massDestroy')->name('surveys.massDestroy');
    Route::resource('surveys', 'SurveyController');

    // Answers
    Route::delete('answers/destroy', 'AnswersController@massDestroy')->name('answers.massDestroy');
    Route::resource('answers', 'AnswersController');

    // Agent
    Route::delete('agents/destroy', 'AgentController@massDestroy')->name('agents.massDestroy');
    Route::resource('agents', 'AgentController');

    // Scheduler
    Route::delete('schedulers/destroy', 'SchedulerController@massDestroy')->name('schedulers.massDestroy');
    Route::resource('schedulers', 'SchedulerController');

    // User Habits
    Route::delete('user-habits/destroy', 'UserHabitsController@massDestroy')->name('user-habits.massDestroy');
    Route::resource('user-habits', 'UserHabitsController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Habits
    Route::delete('habits/destroy', 'HabitsController@massDestroy')->name('habits.massDestroy');
    Route::post('habits/media', 'HabitsController@storeMedia')->name('habits.storeMedia');
    Route::post('habits/ckmedia', 'HabitsController@storeCKEditorImages')->name('habits.storeCKEditorImages');
    Route::resource('habits', 'HabitsController');

    // Survey
    Route::delete('surveys/destroy', 'SurveyController@massDestroy')->name('surveys.massDestroy');
    Route::resource('surveys', 'SurveyController');

    // Answers
    Route::delete('answers/destroy', 'AnswersController@massDestroy')->name('answers.massDestroy');
    Route::resource('answers', 'AnswersController');

    // Agent
    Route::delete('agents/destroy', 'AgentController@massDestroy')->name('agents.massDestroy');
    Route::resource('agents', 'AgentController');

    // Scheduler
    Route::delete('schedulers/destroy', 'SchedulerController@massDestroy')->name('schedulers.massDestroy');
    Route::resource('schedulers', 'SchedulerController');

    // User Habits
    Route::delete('user-habits/destroy', 'UserHabitsController@massDestroy')->name('user-habits.massDestroy');
    Route::resource('user-habits', 'UserHabitsController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
    Route::post('profile/toggle-two-factor', 'ProfileController@toggleTwoFactor')->name('profile.toggle-two-factor');
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});
