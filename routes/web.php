<?php


Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::post('profile/change_avatar', 'ProfileController@updateAvatar')->name('change_avatar');
    Route::put('profile/update', 'ProfileController@update')->name('profile_update');
    Route::get('profile/edit', 'ProfileController@edit')->name('profile_edit');

    Route::get('/leads', 'LeadController@leads')->name('leads');
    Route::get('/transactions', 'TransactionController@index')->name('transactions');
    Route::get('/portfolio', function () {return view('portfolio');})->name('portfolio');
    Route::get('/customers', function () {return view('customers');})->name('customers');
    Route::get('/income_and_expenses', function () {return view('income_and_expenses');})->name('income_and_expenses');
    Route::resource('user', 'UserController');

    Route::resource('lead', 'LeadController');
    Route::resource('client', 'ClientController')->only('store');
    Route::resource('transaction', 'TransactionController');

    Route::put('lead_approved', 'LeadController@leadApproved')->name('lead_approved');

    Route::post('show_lead_info', 'LeadController@showLeadInfo')->name('show_lead_info');
    Route::post('show_transaction_info', 'LeadController@showTransactionInfo')->name('show_transaction_info');
    Route::post('get_cities', 'LeadController@getCities')->name('get_cities');
    Route::post('set_reception', 'LeadController@setReception')->name('set_reception');
    Route::post('change_reception', 'TransactionController@changeReception')->name('change_reception');
    Route::post('save_deals_info/{id}', 'TransactionController@saveDealsInfo')->name('save_deals_info');
    Route::post('new_type', 'TransactionController@newType')->name('new_type');
    Route::post('description_update', 'TransactionController@descriptionUpdate')->name('description_update');
    Route::resource('transaction_description', 'TransactionDescriptionController');
    Route::post('transaction/{id}/updateStatus', 'TransactionController@updateStatus')->name('updateStatus');
    Route::post('/take_on_check', 'LeadController@takeOnCheck')->name('take_on_check');
    Route::get('/check', 'LeadController@leadCheck')->name('lead_check');
    Route::resource('transaction_notification', 'TransactionNotificationController')->only(['store', 'destroy']);
    Route::post('/lead_decline', 'LeadController@leadDecline')->name('lead_decline');
    Route::post('/lead_remake', 'LeadController@leadRemake')->name('lead_remake');
    Route::post('/lead/lead_waiver', 'LeadController@leadWaiver')->name('lead_waiver');
    Route::post('/lead/lead_approval', 'LeadApprovalController')->name('lead_approval');
    Route::get('birthday', 'BirthdayController')->name('birthday');
    Route::resource('questions', 'QuestionController');

    Route::group(['prefix' => 'pyramid'], function () {
        Route::get('leads', 'ajax\PyramidController@leadsPyramid')->name('lead_pyramid');
        Route::get('leads_get', 'ajax\PyramidController@leadsPyramidGet')->name('lead_pyramid_Get');
        Route::get('transactions_auto', 'ajax\PyramidController@transactionsPyramidAuto')->name('transactions_pyramid_auto');
        Route::get('transactions_real_estate', 'ajax\PyramidController@transactionsPyramidRealEstate')->name('transactions_pyramid_real_estate');
    });

    Route::name('ajax.menu_notification.')->prefix('ajax/menu_notification')->group(function () {
        Route::get('transaction', 'ajax\MenuNotificationController@transaction')->name('transaction');
        Route::get('lead', 'ajax\MenuNotificationController@lead')->name('lead');
    });

    Route::name('ajax.')->prefix('ajax/tables')->group(function () {
        //transaction
        Route::name('table.transaction.')->group(function () {
            Route::get('transaction_main', 'ajax\TransactionTableController@main')->name('main');
        });
    });

    route::get('test', 'TestController');

    Route::prefix('ajax')->group(function () {
        Route::get('all_leads_table', 'ajax\AllLeadsTableController')->name('ajax_all_leads_table');
        Route::get('take_on_check_table', 'ajax\leadTableController@takeOnCheck')->name('take_on_check_table');
        Route::get('make_appointment_table', 'ajax\leadTableController@makeAppointment')->name('make_appointment_table');
        Route::get('question_table', 'ajax\QuestionController')->name('question_table');
        Route::get('underwriters_working_time_table', 'ajax\UnderwritersWorkingTimeTable')->name('underwriters_working_time_table');

    });
});
Route::get('test', function () {
    return view('test');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    // list all lfm routes here...
});