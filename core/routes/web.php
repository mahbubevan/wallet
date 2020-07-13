<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('landing');

Route::post('/send_public','PublicController@store_email')->name('email.store');

// Auth::routes();



#############################
// ##### User Routes ##### //
#############################
Route::prefix('user')->name('user.')->group(function () {

    ## Login Routes ##
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    ## Registration Routes ##
    Route::get('register/{username}', 'Auth\RegisterController@showRegistrationForm'); 
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register')->name('register');

    ##########################
    ## Password Reset Routes ##
    ###########################
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('token_verification','Auth\ForgotPasswordController@verify_token')->name('token.verify');



    ###################### ########
    ##### Auth Middleware For User

    Route::middleware('auth')->group(function(){
        ## User Homepage ###
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard','HomeController@dashboard')->name('dashboard');
    Route::get('/transaction','HomeController@transaction')->name('transaction');
    Route::get('/send_transaction','HomeController@send_transaction')->name('send.transaction');
    Route::get('/rcv_transaction','HomeController@rcv_transaction')->name('rcv.transaction');
    Route::get('/ref_bonus','HomeController@ref_transaction')->name('ref.transaction');
    Route::get('/ref_list','HomeController@ref_list')->name('ref.list');
    Route::get('/admin_transaction','HomeController@admin_trans')->name('admin.transaction');

    ### User PRofile ####
    ######################
    Route::get('/profile', 'ProfileController@index')->name('profile');
    // Route::get('/profile/{profile}/edit','ProfileController@edit')->name('profile.edit');
    Route::post('/profile/{profile}','ProfileController@update')->name('profile.update');
   
    ############## SEND MONEY #############e
    Route::get('/send_money','TransactionController@index')->name('sendmoney');
    Route::get('/send_money/{username}','TransactionController@index')->name('name.sendmoney');
    Route::post('/send_money','TransactionController@store')->name('sendmoney.store');

    #### Send Ref Link #### 
    Route::post('/send_ref_link','HomeController@send_ref_link')->name('sendreflink');
    Route::get('refer_to','HomeController@refer')->name('referto');

    
    });
});

#########################
#### ADMIN ROUTES #######
#########################

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    ### Admin AUTH ROUTES ###
    Route::namespace('Auth')->group(function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::get('logout', 'LoginController@logout')->name('logout');


         #################################
        ####### Admin Pass Reset ######## 
        #################################

        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('token_verification','ForgotPasswordController@verify_token')->name('token.verify');
    });

       

        #################################
        ####### Admin Auth Routes ######## 
        #################################

    Route::middleware('admin')->group(function () {

        // Side Bar Routes //
        Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('/userlist', 'UserController@dashboard')->name('userlist');
        Route::get('/transaction', 'TransactionController@transaction')->name('transaction');
        Route::get('/ref_transaction', 'TransactionController@ref_trans')->name('ref.transaction');
        Route::get('/admin_transaction', 'TransactionController@admin_trans')->name('admin.transaction');

        // Navbar Routes //
        Route::get('/give_bonus','AdminController@bonus_page')->name('give.bonus');
        Route::get('/add_new_currency','AdminController@currency_page')->name('add.currency');
        Route::get('/settings','AdminController@setting_page')->name('setting');

        // User Profile //
        Route::get('/profile/{profile}','UserController@show')->name('user.profile');
        Route::post('/profile/{profile}','UserController@update');
        Route::get('profile/{profile}/delete','UserController@destroy')->name('user.destroy');

        // Settings ROutes //
        Route::post('/settings','SettingController@update');

        // Give Bonus TO ALl USER //
        Route::post('/give_bonus','BonusController@update');

        //  Add NEw Currecy 
        Route::post('/add_new_currency','CurrencyController@store');

        //  By User //
        Route::get('/transaction/{id}','TransactionController@transaction_by_user')->name('user.transaction');
        Route::get('/send_money/{id}','TransactionController@send_transaction')->name('user.send.transaction');
        Route::get('/rcv_money/{id}','TransactionController@rcv_transaction')->name('user.rcv.transaction');
        Route::get('/ref_trans/{id}','TransactionController@ref_transaction')->name('user.ref.transaction');
        Route::get('/ref_list/{id}','TransactionController@ref_list')->name('user.ref.list');
        Route::get('/admin_bonus/{id}','TransactionController@admin_trans_by_id')->name('user.admin.transaction');



        Route::get('/search','SearchController@index')->name('search');
        Route::post('/search','SearchController@get_data');
        Route::post('/user_search','SearchController@get_user_data');

        // Notification 
        Route::get('/notification','NotificationController@notification')->name('notification');
        Route::get('/notification/{notification}','NotificationController@make_reverse')->name('notification.reverse');

        // Emails 
        Route::get('/emails','EmailController@index')->name('check.emails');
        Route::get('/email/{email}','EmailController@make_reverse')->name('email.reverse');
        // Route::get('/notification/{id}','NotificationController@make_unseen')->name('notification.unseen');

        Route::get('/auth_by_id/{id}','AdminController@loginUsingId')->name('user.byId');

        // Add Balance By Admin 
        Route::post('/add_balance','TransactionController@add_balance')->name('user.add.balance');
        Route::post('/sub_balance','TransactionController@sub_balance')->name('user.sub.balance');
    });
});



#########################
#### TEST CONTROLLER ####
#########################

Route::get('test', 'TestController@test');
