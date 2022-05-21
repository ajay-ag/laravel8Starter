<?php

use Illuminate\Support\Facades\Route;

// Dashboard

Route::group(['namespace' => 'Auth'], function () {
  // Login
  Route::get('login', 'LoginController@showLoginForm')->name('login');
  Route::post('login', 'LoginController@login');
  Route::get('logout', 'LoginController@logout')->name('logout');
  // Register
  Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
  Route::post('register', 'RegisterController@register');
  // Reset Password
  Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
  Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
  Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
  Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
  // Confirm Password
  Route::get('password/confirm', 'ConfirmPasswordController@showConfirmForm')->name('password.confirm');
  Route::post('password/confirm', 'ConfirmPasswordController@confirm');
  // Verify Email
  Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
  Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
  Route::post('email/resend', 'VerificationController@resend')->name('verification.resend');
});

Route::group(['middleware' => ['admin.auth:admin', 'admin.verified']], function () {

  Route::get('/dashboard', 'HomeController@index')->name('home');

  Route::resource('profile', 'ProfileController');
  Route::get('profile/email/unique', 'ProfileController@emailUnique')->name('user.email.unique');
  Route::post('profile/update-image/{admin}', 'ProfileController@updateImage')->name('profile.update.image');

  Route::get('category/exists', 'CategoryController@exists')->name('category.exists');
  Route::post('category/{id}/status', 'CategoryController@changeStatus')->name('category.status');
  Route::post('category/data-list', 'CategoryController@dataList')->name('category.dataList');
  Route::get('get/category', 'CategoryController@categoryList')->name('get.category');
  Route::resource('category', 'CategoryController');

  Route::get('sub-category/exists', 'SubCategoryController@exists')->name('sub-category.exists');
  Route::post('sub-category/{id}/status', 'SubCategoryController@changeStatus')->name('sub-category.status');
  Route::post('sub-category/data-list', 'SubCategoryController@dataList')->name('sub-category.dataList');
  Route::resource('sub-category', 'SubCategoryController');

  Route::post('newsletter/list', 'NewsletterController@dataListing')->name('newsletter.list');
  Route::resource('newsletter', 'NewsletterController');

  Route::post('contact/list', 'ContactController@dataListing')->name('contact.list');
  Route::resource('contact', 'ContactController');

  Route::group(['namespace' => 'Access'], function () {
    Route::post('user/list', 'UserController@dataList')->name('user.dataList');
    Route::post('user/{id}/status', 'UserController@changeStatus')->name('user.status');
    Route::get('user/email/unique', 'UserController@emailUnique')->name('user.email.unique');
    Route::resource('user', 'UserController');

    Route::get('get/role', 'RoleController@getRoleList')->name('get.role');
    Route::post('assign/{role}/permission', 'RoleController@assignPermission')->name('role.permission.assign');
    Route::post('role/exists', 'RoleController@roleExists')->name('role.exists');
    Route::post('role/data-list', 'RoleController@dataList')->name('role.dataList');
    Route::post('role/{id}/status', 'RoleController@changeStatus')->name('role.status');
    Route::resource('role', 'RoleController');

    Route::get('get/permission', 'PermissionController@getPermissionList')->name('get.permission');
    Route::post('permission/exists', 'PermissionController@permissionExists')->name('permission.exists');
    Route::post('permission/data-list', 'PermissionController@dataList')->name('permission.dataList');
    Route::post('permission/{id}/status', 'PermissionController@changeStatus')->name('permission.status');
    Route::resource('permission', 'PermissionController');
  });

  Route::group(['namespace' => 'Settings', 'middleware' => []], function () {

    Route::get('website-setting', 'SettingController@showSettingPage')->name('website-setting');
    Route::resource('settings', 'SettingController');
    Route::resource('smtp', 'SmtpSettingController');
  });
});