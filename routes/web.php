<?php
/* 
|------------------------------------------------
| Custom Defined Routes 
|------------------------------------------------
*/

//Routes for Authenticated User ->>
// Middleware has been set up inside each main controller

//================== A D M I N ===================  

//======================  p a g e  ======================
//====================== a d m i n ======================
Route::group(['middleware' => 'auth'], function () {
    Route::name('admin.')->group(function () {  
        Route::group(['prefix' => 'admin'], function () {
        // - - - - - - - -   d a s h b o a r d  - - - - - - - - -
            Route::get('/dashboard','Web\Admin\BaseAdminController@dashboard')->name('dashboard');
            //======================  p a g e  ======================
            //=============== a d m i n - m a n a g e ===============
            Route::group(['prefix' => 'manage-admin'], function () {
                Route::get('/admins','Web\Admin\BaseAdminController@manageAdmins')->name('man.admins');
                Route::get('/{id}','Web\Admin\BaseAdminController@editAdmins')->name('edit.admins');
                Route::post('/delete/','Web\Admin\BaseAdminController@deleteAdmins')->name('del.admins');
                Route::post('/update','Web\Admin\BaseAdminController@updateAdmins')->name('update.admins');
                Route::post('/add/admin','Web\Admin\BaseAdminController@addAdmins')->name('add.admins');
                Route::post('/add/store','Web\Admin\BaseAdminController@storeAdmins')->name('store.admins');
                
                Route::get('/new/{code}', 'Web\Admin\BaseAdminController@newAdminInvite')->name('new.admin.invite');
                Route::post('/new/admin','Web\Admin\BaseAdminController@postNewAdmin')->name('new.admin.invite.post');

                //==================  Reset and Activate  ===================
                Route::get('/admins/activate/admin/{id}', 'Web\Admin\BaseAdminController@activateDeactivate')->name('activate');
                Route::get('/admins/reset/{id}', 'Web\Admin\BaseAdminController@resetuserPassword')->name('reset');

                //==================  P R O F I L E  ===================
                Route::get('/admins/profile','Web\Admin\BaseAdminController@profileAdmins')->name('profile.admins');
                Route::post('/admins/profile','Web\Admin\BaseAdminController@postProfileAdmins')->name('post.profile.admins');
            });

            //======================  p a g e  ======================
            //======================  u s e r  ======================
            Route::group(['prefix' => 'manage-user'], function () {
                Route::get('/users','Web\Admin\BaseAdminController@manageUsers')->name('man.users');
                Route::get('/users/{id}','Web\Admin\BaseAdminController@editUsers')->name('edit.users');
                Route::post('/users/delete','Web\Admin\BaseAdminController@deleteUsers')->name('del.users');
                Route::get('/profile/users/{id}','Web\Admin\BaseAdminController@profileUsers')->name('profile.users');
                Route::post('/users/update','Web\Admin\BaseAdminController@updateUsers')->name('update.users');

                //====================  Add New User  ===================
                Route::post('/users/add/user','Web\Admin\BaseAdminController@addUsers')->name('add.users');
                Route::post('/users/add/store','Web\Admin\BaseAdminController@storeUsers')->name('store.users');
                Route::get('/users/new/{code}', 'Web\Admin\BaseAdminController@newUserInvite')->name('new.user.invite');
                Route::post('/users/new/invite','Web\Admin\BaseAdminController@postNewUser')->name('new.user.invite.post');
            });
        });
    });

    //==================  U S E R  ===================
    Route::name('user.')->group(function () {
        Route::group(['prefix' => 'user'], function () {
            // - - - - - - - -   d a s h b o a r d  - - - - - - - - -
            Route::get('/dashboard','Web\App\BaseUserController@dashboard')->name('dashboard');

            //======================  p a g e  ======================
            //======================  t a s k  ====================== 
            Route::group(['prefix' => 'manage'], function () {
                Route::get('/task','Web\App\BaseUserController@manageTask')->name('task');
                Route::post('/task/add','Web\App\BaseUserController@addTask')->name('add.task');
                Route::get('/task/{id}','Web\App\BaseUserController@editTask')->name('edit.task');
                Route::post('/task/delete','Web\App\BaseUserController@deleteTask')->name('del.task');
                Route::get('/task/edit/{id}','Web\App\BaseUserController@viewEditTask')->name('v_edit.task');
                Route::post('/task/update','Web\App\BaseUserController@updateUserTasks')->name('update.task');
            });

            //======================  p a g e  ======================
            //===================  a c c o u n t  ====================
            Route::group(['prefix' => 'account'], function () {
                Route::get('/manage/','Web\App\BaseUserController@manageAccount')->name('man');
                Route::get('/manage/{id}','Web\App\BaseUserController@editAccount')->name('edit');
                Route::get('/manage/update/{id}','Web\App\BaseUserController@updateAccount')->name('update');
            });
        });
    });
    Route::get('/logout', 'Web\App\Auth\LoginController@getLogout')->name('logout');
});

//Routes for UnAuthenticated User A.K.A Guest ->
Route::group(['middleware' => 'guest'], function () {
    //================== L O G I N ===================
    Route::get('/login', 'Web\App\Auth\LoginController@showLogin')->name('login');
    Route::post('/login', 'Web\App\Auth\LoginController@detectLogin')->name('detectLogin');


    //================ R E D I R E C T ===============
    Route::get('/', 'Web\App\Auth\DashboardController@index');
    Route::get('/home', 'Web\App\Auth\loginController@detectLogin')->name('detect');


    //================ R E G I S T E R ===============
    Route::get('/register', 'Web\App\Auth\RegisterController@getRegister')->name('register');
    Route::post('/register', 'Web\App\Auth\RegisterController@storeRegister')->name('post.register');
    Route::get('/register/activate/{code}', 'Web\App\Auth\RegisterController@activateUser')->name('activate.register');


    //================== F O R G O T =================
    Route::get('/forgot', 'Web\App\Auth\ForgotPassController@index')->name('forgot');
    Route::post('/forgot', 'Web\App\Auth\ForgotPassController@forgotPass')->name('recover.password');
    Route::get('/forgot/recover/{code}', 'Web\App\Auth\ForgotPassController@renewPassword')->name('new.password');
    Route::post('/forgot/recover/new', 'Web\App\Auth\ForgotPassController@newPass')->name('new.pass');
});







