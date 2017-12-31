<?php

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
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('edit-gen', function () {
    $type = '$taxi';
    $fields = ['callcode_id', 'taxiNo', 'taxiChasisNo', 'taxiEngineNo', 'taxiBrand', 'taxiModel', 'taxiColor', 'taxiOwnerName', 'taxiOwnerMobile', 'taxiOwnerEmail', 'taxiOwnerAddress', 'registeredDate', 'anualFeeExpiry', 'roadWorthinessExpiry', 'insuranceExpiry', 'rate', 'taken', 'center_name'];
    foreach ($fields as $field) {
        echo htmlentities('<th>');
        echo $field;
        echo htmlentities('</th>');
        echo '<br>';
    }

});


/*Payment generation*/
Route::get('genpayment', function () {
    $payments = App\paymentHistory::where('month', date("m"))
                                  ->where('year', date("Y"))
                                  ->first();
    
    if ($payments) {
        $info = array('status' => 'payment already generated for this month');
        return response()->json([$info]);
    }
    
    else
    {
        $taxis = App\Taxi::all();
        foreach ($taxis as $taxi) {
            App\paymentHistory::create([
                'taxi_id' => $taxi->id,
                'month' => date("m"),
                'year' => date("Y"),
                'desc' => "Monthly Taxi Fee",
            ]);
            
        }

        $taxiUp = App\Taxi::where('state', '1')->update(['state' => 0]);
        
        return redirect()->route('payment')->with('success','Payment Generated Successfully.');
    }    

    
});

/*
|--------------------------------------------------------------------------
|Configure Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'configure'], function () {
    
    /*Company Configure Routes*/
    Route::group(['prefix' => 'company'], function () {
        Route::get('/', 'CompanyController@index');
        
        Route::get('/add', 'CompanyController@create');
        Route::post('/add', 'CompanyController@store');
        
        Route::get('/view/{id}', 'CompanyController@view');
        
        Route::get('/update/{id}', 'CompanyController@edit');
        Route::post('/update/{id}', 'CompanyController@update');
        
        Route::get('/delete/{id}', 'CompanyController@destroy');
    });
    /*End of Company Configure Routes*/

    /*Taxi Center Configure Routes*/
    Route::group(['prefix' => 'taxi-center'], function () {
        Route::get('/', 'TaxicenterController@index');
        
        Route::get('/add', 'TaxicenterController@create');
        Route::post('/add', 'TaxicenterController@store');
        
        Route::get('/view/{id}', 'TaxicenterController@view');
        
        Route::get('/update/{id}', 'TaxicenterController@edit');
        Route::post('/update/{id}', 'TaxicenterController@update');
        
        Route::get('/delete/{id}', 'TaxicenterController@destroy');
    });
    /*End of Taxi Center Configure Routes*/

    /*Call Code Configure Routes*/
    Route::group(['prefix' => 'call-code'], function () {
        Route::get('/', 'CallCodeController@index');
        
        Route::get('/add', 'CallCodeController@create');
        Route::post('/add', 'CallCodeController@store');
        
        Route::get('/view/{id}', 'CallCodeController@view');
        
        Route::get('/update/{id}', 'CallCodeController@edit');
        Route::post('/update/{id}', 'CallCodeController@update');
        
        Route::get('/delete/{id}', 'CallCodeController@destroy');
    });
    
    /*End of Call Code Configure Routes*/

    /*Taxi Configure Routes*/
    Route::group(['prefix' => 'taxi'], function () {
        Route::get('/', 'TaxiController@index');
        
        Route::get('/add', 'TaxiController@create');
        Route::post('/add', 'TaxiController@store');
        
        Route::get('/view/{id}', 'TaxiController@view');
        
        Route::get('/update/{id}', 'TaxiController@edit');
        Route::post('/update/{id}', 'TaxiController@update');
        
        Route::get('/delete/{id}', 'TaxiController@destroy');
    });
    
    /*End of Taxi Configure Routes*/

    /*Driver Configure Routes*/
    Route::group(['prefix' => 'driver'], function () {
        Route::get('/', 'DriverController@index');
        
        Route::get('/add', 'DriverController@create');
        Route::post('/add', 'DriverController@store');
        
        Route::get('/view/{id}', 'DriverController@view');
        
        Route::get('/update/{id}', 'DriverController@edit');
        Route::post('/update/{id}', 'DriverController@update');
        
        Route::get('/delete/{id}', 'DriverController@destroy');
        Route::get('/ajax/{id}', 'DriverController@ajax');
    });
 
    /*End of Driver Configure Routes*/
});



/*
|--------------------------------------------------------------------------
|Payment Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'payments'], function () {
    Route::get('taxi-payment', 'PaymentHistoryController@index')->name('payment');
    Route::post('taxi-payment', 'PaymentHistoryController@add');
    Route::get('taxi-payment/view', 'PaymentHistoryController@view');
});

/*
|--------------------------------------------------------------------------
|Diplay Routes (JR)
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'display'], function () {
    Route::get('jr', 'DisplayController@jrIndex');

    Route::get('jr-ajax', function () {
        $taxis = App\Taxi::where('center_name', 'JRMM')->where('taken', '1')->get();
        $payments = App\paymentHistory::all();
        return view('display.Ajax', compact('taxis', 'payments'));
    });

    Route::get('city-cab', 'DisplayController@cityIndex');

    Route::get('city-ajax', function () {
        $taxis = App\Taxi::where('center_name', 'CBMM')->where('taken', '1')->get();
        $payments = App\paymentHistory::all();
        return view('display.Ajax', compact('taxis', 'payments'));
    });

    Route::get('driver-ajax/{id}', function ($id) {
        $driver = App\Driver::find($id);
        return view('configure.driverAjax', compact('driver'));
    });
});

/*
|--------------------------------------------------------------------------
|SMS Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'sms'], function () {
    Route::get('/', 'SmsController@index'); 
    Route::post('/', 'SmsController@send'); 
});