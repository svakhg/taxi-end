<?php
use Illuminate\Http\Request;
use Mohamedathik\PhotoUpload\Upload;
use App\Helpers\Helper;
use App\paymentHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

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
    return view('home');
})->middleware('auth');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'test', 'middleware' => 'auth'], function () {
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
    Route::get('sql-gen', function () {
        $id = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60', '61', '62', '63', '64', '65', '66', '67', '68', '69', '70', '71', '72', '73', '74', '75', '76', '77', '78', '79', '80', '81', '82', '83', '84', '85', '86', '87', '88', '89', '90', '91', '92', '93', '94', '95', '96', '97', '98', '99', '100', '101', '102', '103', '104', '105', '106', '107', '108', '109', '110', '111', '112', '113', '114', '115', '116', '117', '118', '119', '120', '121', '122', '123', '124', '125', '126', '127', '128', '129', '130'];
        $taxi = ['6548', '5654', '3625', '4676', '4061', '5483', '1294', '6744', '1066', '4531', '7094', '5615', '3396', '4788', '5937', '1623', '5513', '2508', '3935', '3593', '4110', '4710', '3126', '3313', '4516', '3683', '2551', '4530', '5856', '4240', '5598', '4556', '9196', '3428', '5743', '6430', '2452', '4798', '5680', '2574', '3972', '5357', '6443', '2519', '4063', '6708', '2943', '5553', '6912', '3375', '4010', '3961', '8491', '3708', '5093', '2595', '4563', '2196', '1631', '3568', '6562', '5305', '8263', '4599', '4527', '7723', '4129', '5518', '4722', '3474', '2878', '1198', '5058', '1896', '2009', '5438', '3554', '4066', '4780', '1733', '4897', '9661', '4960', '2386', '2981', '5082', '7574', '7372', '3904', '7448', '5112', '8403', '7629', '5268', '8569', '3789', '4065', '7884', '2822', '8066', '8262', '3791', '4790', '8853', '5672', '7687', '7450', '7283', '7650', '1896', '3061', '8667', '2695', '3795', '3139', '4615', '8754', '1792', '8577', '4482', '9481', '3652', '8652', '9269', '5635', '3967', '8223', '4673', '1124', '4060'];
        $null = 'NULL';
        $driver = ['Ibrahim Manik', 'Abbas mohamed', 'hussain habeeb', 'Ibrahim Mohamed', 'Mohamed Naseer', 'Hassan Mohamed Didi', 'Mohamed Shifar', 'Mohamed Zahir', 'Hassan Ismail', 'Ahmed Nazeel', 'Abdul Rahmam Hussain', 'mohamed faisal', 'Nuruzaman', 'Ismail Naseem', 'n', 'Hamdoon Waheed', 'Ismail Shareef', 'Abdul Razzag Jabir', 'Jinah Abdul Sattar', 'Saheedha Ahmed', 'Abdul Baari Hassan', 'Mohamed Adam', 'Mohamed Husaain', 'Anwar Ali', 'Mohamed Rafeeq', 'Ibrahim Shareef', 'Hassan Eesa', 'Ibrahim Haleem', 'Mohamed Niza', 'Fathuhulla Rafeeu', 'Aiminathu Hudha', 'IBRAHIM MOOSA', 'Easa Fathuhee', 'Ali Najeeb', 'N', 'Ahmed Hussain', 'Abdulla Rasheed', 'Ibrahim Wajdee', 'Ahmed Rasheed', 'Hassan Thaufeeg', 'Adam Naseer', 'Mohamed Moosa', 'Ahmed Nazeel', 'Moosa Manik', 'Nizar Abdulla', 'Saudulla Mohamed', 'Ahmed Mujuthaba', 'Mariyam Mizna', 'Hussain Abdul Rahmaa', 'Ahmed Nazeel', 'Ibrahim Shihab', 'Mohamed Moosa / Mi', 'Ibrahim Rasheed', 'n', 'Ali Nizam', 'Adam Naseer', 'N', 'Hussain Ismail', 'Ahmed Mujuthaba', 'Ibrahim Shihab', 'Ibrahim Mohamed', 'Ibrahim Jabir', 'Hussain Miyad', 'aminath azka abdulla', 'Hadheeja Abdul Rahma', 'Mohamed Shifaz', 'Ismail Madheeh', 'Ibrahim Fareesh', 'Ibrahim Rasheed', 'Sunain Abdulla', 'Faisal Ibrahim', 'Salim Adam', 'Ibrahim Jamsheed', 'Ahmed Mohamed', 'Fathumathu Azufaa Am', 'Shaheen', 'Ibrahim Mohamed', 'Mariyam Ifaa Ahmed', 'Mohamed Riffath Abd', 'Nazeer Ali', 'Lomir Ibrahim', 'Ahmed Amir', 'Abdulla Majeed', 'Ahmed Faiz Mohamed', 'Anwar Ali', 'Saeed Didi', 'Gasim Saud', 'Ahmwd Anil', 'Ibrahim Waheed', 'Ibrahim Latheef', 'Hassan Rasheed', 'Not Available', 'Ismail Rsheed', 'Ahmed Samir', 'NO NAME', 'Abudhil Gayyoom', 'NO NAME', 'NO NAME', 'Abdul Shakoor Moosa', 'N', 'Mohamed Abdulla', 'NO NAME', 'Abudhil Gayyoom', 'NO NAME', 'Ahmed Ali', 'NO NAME', 'Ahmed Mohamed', 'Mohamed Nizam', 'Abdul Jaleel Abdulla', 'Ali Shareef', 'Mohamed Razee', 'NO NAME', 'Ahmed Zaheen', 'Abdul Ghafoor Abdul', 'Irfan Mohamed / M', 'Hamza Adnan', 'Ahmed Shaf', 'Valeed Ibrahim', 'Hassan Rameez', 'Ibrahim Sodig', 'Ibrahim Sharu-u', 'Hassan Mohamed', 'Waheed Mohamed', 'Ahmed Naseer', 'n', 'M', 'n', 'n', 'Ahmed Aslam', 'n'];
        $phone = ['7783135', '7771503', '7778187', '7753132', '9851234', '9777666', '9946566', '7652273', '7750723', '9639530', '7999799', '9990611', '7976757', '9801112', '9977299', '9764736', '7874814', '7771986', '7944508', '7649753', '7835336', '9868080', '7979090', '9881199', '7735677', '7865553', '7801082', '7775059', '7791002', '7794937', '7772097', '9773028', '9792935', '7861004', '9121313', '7993737', '7781945', '9808097', '7989875', '9881462', '9823136', '7993617', '7774055', '7872611', '7775054', '7870209', '7778072', '9133353', '7784636', '7774055', '9967777', '7791223', '7655696', 'Not Available', '9966020', '7833870', '9725072', '7980086', '7778072', '7901140', '9773132', '7890001', '7891939', '7974401', '7961774', '7873840', '7910028', '9963125', '9960374', '7861540', '7637970', '7782311', '9747570', '9994645', '7778186', '9893323', '7610066', '7778186', '7792825', '7744605', '9742122', '7778186', '7596970', '7714401', '9881199', '9971515', '7929292', '7778823', '9977709', '7699993', '9973300', 'Not Available', '9868056', '9922933', '7771831', '7522559', '7727476', '7768860', '9906655', '7610030', '7992300', '7931979', '7522559', '7821577', '7828654', '7778029', '9994645', '9956777', '7799729', '7732564', '9888887', '9878987', '7568342', '7955506', '9165432', '9550066', '5959595', '7970102', '7774713', '7989442', '7864368', 'Not Available', '7986080', '7849484', '9857265', '7909038', '9918989', '7774055', '9933307', 'Not Available'];
        $address = ['M M H D 6703/Male', 'M . Aalimas / K . Male', 'Dhafthar/male', 'Hiyafahi/HDh.Kulhudhuffushi', 'Mirihimaage / Th . Gaadhiffushi', 'Breeve/Male', 'Evening Star /Male', 'Jaree Villa / K . Male', 'Eththeyomaage/Male', 'Ma. Lilly of Tha Velley / k . Male', 'Ranbusthaanuge / Hdh . Kulhudhuffushi', 'Ha.ihavandhoo/haasil', 'Nivigasdhoshuge/GDh.Madaveli', 'keveli /k. huraa', 'n', 'Tea Rose/H.Hinmafushi', 'G.Haalam/Male', 'Ma. Orchard 2 / k. Male', 'G.Visenza/Male', 'Kashimaage/sh.maroshi', 'Dhaftharu No.Rs 9511/Male', 'H. Naseemeevila / K. Male', 'Kuredhivaruge/Sh.Funadhoo', 'Javaahirumaage/AA.Himandhoo', 'Husnuheenaage/GA.Vilingili', 'Hirudhumaage/HA.Kelaa', 'Dhaftharu No. Rs 8089/Male', 'Dhaftharu No RS 9284/Male', 'M. Manz /k.Male', 'Fine Beach/S.Hithadhoo', 'Violetvilla / S.Hulhudhoo', 'DHAFTHARU 8061 / K . MALE', 'Nafaa Villa/L.Maavah', 'Dhaftharu No. RS 4152/Male', 'Ethumaage/Sh.Lhaimagu', 'Reynige/M.Maduvvari', 'Iruzuvaage/HDh.Nolhivaran', 'G . Chaandu/Male', 'Grey Shells/Male', 'Oceanview/GA.Vilingili', 'Mirihimaage/Sh.Maroshi', 'Naares / GD. Gadhdhoo', 'Ma. Lilly of Tha Velley / k . Male', 'H.Malagas/Male', 'Munnaarudhoshuge / GD. Gadhdhoo', 'Vaimatheege / Ga. Dhevvadhoo', 'Ma. MayfairLog / K. Male', 'N', 'N', 'Ma. Lilly of Tha Velley / k . Male', 'Finiroalhi/L.Gan', 'New Star/HDh.Kulhudhuffushi', 'Dhaftharu No. RS 8051/Male', 'N', 'Riveli/HA.Kelaa', 'Dhaftharu No RS 7782', 'Waheedhee Manzil/S.Hithadhoo', 'Busthanuge /Lh. Hinnavaru', 'Ma. MayfairLog / K. Male', 'Alivaage / k. Guraidhoo', 'M.Boaddoo/Male', 'Dhaftharu No RS 3088', 'Sabnamge/k.Maafushi', 'Naagali / th.Gaadhifushi', 'V.Felidhoo / Reehaan Manzil', 'Shehenaaz Villa / S . Feydhoo', 'H.chinaar', 'Fehivinamaage/K.Maafushi', 'Kanmathee Villa/Ga.Villingili', 'Kafamaage/Gdh.Gadhdhoo', 'Ma.Abaa/Male', 'Saathee/Adh.Dhangethi', 'Water Villa/ K. Dhiffushi', 'Seeteyriyaa/HDh.kulhudhuffushi', 'Fehifarudhaage / S. Maradhoo', 'Lh.Naifaru', 'Roshaneevilaa / AA . Bodufolhudho', 'Fehifarudhaage / S. Maradhoo', 'Orchid Villa/B.Eydhafushi', 'M. Rehil k. Male', 'M . Haadhoo / K . Male.', 'Fehifarudhaage / S. Maradhoo', 'M. Bijileege / K. Male', 'N', 'Javaahirumaage/AA.Himandhoo', 'Kabeelaage GDh. Gadhdhoo', 'Aabaadhu / HD.Maavaidhoo', 'H . Galadhunge / K . Male', 'Dhaftharu No 3084/Male', 'Lifadhoo / Ga. Vilingili', 'Hirudhugasdhoshuge/H.Dh Vaikaradhoo', 'N', 'M. MiyavAli / K. Male', 'Fehivina/B.Hithadhoo', 'N', 'Dhaftharu No 10487 /Male', 'N', 'N', 'Dhaftharu No 2838/Male', 'N', 'Dhanvaruge/Lh. Naifaru', 'N', 'Dhaftharu No 10487 /Male', 'N', 'Dhaftharu No : Rs 8039 / Male', 'N', 'Seeteyriyaa / Hdh . Kulhudhufushi', 'Asurumaage/Adh.Dhangethi', 'Thundi Noorange /L Gan', 'Jabrolmssge / HD. Nolhivaram', 'Daftharu No: 3822 / K. Male', 'N', 'N', 'Gulfaamge/Lh.kurendhoo', 'Nooraneege /r .Vaadhoo', 'Fehivilla ge/Sh.Feevah', 'Seereenaa Manzil / HDh . Nolhivaranfaru', 'N', 'Dhaftharu No7079. K. Male', 'Zamaaneevilla / GDh / Gadhoo', 'Rabarumaage , Gdh . thinadhoo', 'Summer Hill / K . Male', 'Dhaftharu No :572 K . Male', 'Anoanaage / Sh , Foakaidhoo', 'N', 'N', 'N', 'N', 'N', 'N'];
        $date = ['2/11/2016', '1/1/1970', '2/11/2016', '2/11/2016', '2/11/2016', '2/11/2010', '2/11/2016', '10/9/2012', '3/8/2016', '2/11/2016', '2/11/2016', '4/6/2016', '2/11/2016', '2/11/2016', '10/1/2017', '2/11/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '3/27/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '6/21/2017', '2/20/2016', '2/20/2016', '5/2/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '12/18/2016', '2/20/2016', '2/20/2016', '1/1/2015', '2/20/2016', '5/10/2016', '2/20/2014', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '1/1/1970', '2/20/2016', '2/20/2016', '2/20/2016', '5/2/2016', '2/20/2016', '2/20/2016', '2/20/2016', '2/20/2016', '3/26/2016', '8/10/2017', '2/20/2016', '2/21/2016', '2/21/2016', '2/21/2016', '2/21/2016', '7/5/2015', '2/21/2016', '1/1/1970', '2/11/2016', '3/12/2016', '2/20/2016', '2/20/2016', '3/24/2016', '2/20/2016', '3/24/2016', '6/17/2015', '2/20/2016', '3/25/2016', '2/20/2016', '3/24/2016', '5/2/2016', '3/24/2016', '3/24/2016', '3/24/2016', '3/24/2016', '2/20/2016', '5/1/2016', '9/25/2017', '2/21/2016', '3/24/2016', '2/20/2016', '9/25/2017', '2/20/2016', '1/1/2017', '2/22/2017', '2/23/2010', '3/12/2016', '2/23/2017', '3/25/2017', '3/25/2017', '4/26/2017', '5/11/2017', '9/25/2017', '8/2/2017', '9/25/2017', '1/1/2015', '9/25/2017', '4/1/2013'];
        $rate = '600';
        $up_date = '2017-12-31 11:06:41';
        $cccode = 'JRMM';
        $lfo = 'Taxi/1234/front/original/airporttaxiburlingame2.jpg';
        $lbo = 'Taxi/1234/back/original/airporttaxiburlingame2.jpg';
        $lbt = 'Taxi/1234/back/thumbnail/airporttaxiburlingame2.jpg';
        $lft = 'Taxi/1234/front/thumbnail/airporttaxiburlingame2.jpg';
        $zero = '0';

        for ($i=0; $i < count($id); $i++) {
            echo "(".$id[$i].", '".$id[$i]."', '".$taxi[$i]."', ".$null.", ".$null.", ".$null.", ".$null.", ".$null.", '".$driver[$i]."', ".$null.", ".$null.", '".$address[$i]."', '".$date[$i]."', '".$date[$i]."', '".$date[$i]."', '".$date[$i]."', '".$rate."', '".$zero."', '".$up_date."', '".$up_date."', ".$null.", '".$lfo."', '".$lbo."', '".$lft."', '".$lbt."', '".$cccode."', '".$zero."'),";
            echo '<br>';
        }

    });
    Route::get('callCode-gen', function () {
        $up_date = '2017-12-31 11:06:41';
        for ($i=1; $i < 151; $i++) {
            echo "(".$i.", '1', '".$i."', '".$up_date."', '".$up_date."', NULL, '0'),";
            echo '<br>';
        }
    });
    Route::get('callCode-gen-1', function () {
        $up_date = '2017-12-31 11:06:41';
        $range = range(1, 150);
        $i = '151';
        foreach ($range as $number) {
            echo "(".$i.", '2', '".$number."', '".$up_date."', '".$up_date."', NULL, '0'),";
            echo '<br>';
            $i++;
        }
    });
    Route::get('/driver-dump', function () {
        $payments = paymentHistory::all();
    });

    Route::get('full-callcode-gen', function () {
        $callcodes = \App\CallCode::all();
        foreach ($callcodes as $callcode) {
            $callcode->full_callcode = $callcode->callCode . ' - ' . $callcode->taxicenter->name;
            $callcode->save();
            echo 'Done ' . $callcode->id;
            echo '<br>';
        }
    });

    Route::get('full-taxi-gen', function () {
        $taxis = \App\Taxi::all();
        foreach ($taxis as $taxi) {
            $taxi->full_taxi = 'Call Code: '.$taxi->callcode->callCode.' - Taxi Number: '.$taxi->taxiNo.' Center Name: '.$taxi->callcode->taxicenter->name;
            $taxi->save();
            echo 'Done ' . $taxi->id;
            echo '<br>';
        }
    });
});
/*Payment generation*/
Route::get('payment-generation', function () {
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
})->middleware('auth');
Route::get('/test-driver', function () {
    $drivers = \App\Driver::doesntHave('taxi')->get();
    foreach ($drivers as $driver) {
        echo 'Database ID: '.$driver->id;
        echo '<br>';
        echo 'Driver Name: '.$driver->driverName;
        echo '<br>';
        echo 'Driver Id: '.$driver->driverIdNo;
        echo '<br>';
        echo 'Driver Mobile: '.$driver->driverMobile;
        echo '<hr>';
    }
    if($drivers->isEmpty()){
        echo 'All the added drivers has a taxi';
    }
})->middleware('auth');

Route::get('/test-taxi', function () {
    $taxis = \App\Taxi::doesntHave('driver')->get();
    foreach ($taxis as $taxi) {
        echo 'Database ID: '.$taxi->id;
        echo '<br>';
        echo 'Taxi No: '.$taxi->taxiNo;
        echo '<br>';
        echo 'CallCode: '.$taxi->callcode->callCode;
        echo '<hr>';
    }
    if($taxis->isEmpty()){
        echo 'All the added taxis has a driver';
    }
})->middleware('auth');

Route::get('/test-taxi-2', function () {
    $callcode = \App\CallCode::find(109);
    return $callcode->taxi;
})->middleware('auth');

/*
|--------------------------------------------------------------------------
|Configure Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'configure', 'middleware' => 'auth'], function () {

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

        Route::get('/deactivate/{id}', 'TaxiController@deactivate');
        Route::get('/activate/{id}', 'TaxiController@activate');

        // Route::get('/delete/{id}', 'TaxiController@destroy');

        Route::get('/photo/{id}', 'TaxiController@photo');
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

        // Route::get('/delete/{id}', 'DriverController@destroy');
        Route::get('/deactivate/{id}', 'DriverController@deactivate');
        Route::get('/activate/{id}', 'DriverController@activate');

        Route::get('/photo/{id}', 'DriverController@photo');
        // Route::get('/ajax/{id}', 'DriverController@ajax');
    });

    /*End of Driver Configure Routes*/
});

/*
|--------------------------------------------------------------------------
|Payment Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'payments', 'middleware' => 'auth'], function () {
    Route::get('taxi-payment', 'PaymentHistoryController@index')->name('payment');
    Route::post('taxi-payment', 'PaymentHistoryController@add');
    Route::get('taxi-payment/view', 'PaymentHistoryController@view');
    Route::get('/taxi-payment/receipt/{id}', function ($id) {
        $payment = \App\paymentHistory::findOrFail($id);
        return view('receipt.taxi_payment', compact('payment'));
    });
});

/*
|--------------------------------------------------------------------------
|Diplay Routes
|--------------------------------------------------------------------------
*/
Route::get('/display', function () {
    return view('displayNew.demo');
})->middleware('auth');
Route::get('/display/{center_name}', function ($center_name) {
    $taxis = \App\Taxi::where('center_name', $center_name)->with('driver')->with('callcode')->get();
    $center = \App\TaxiCenter::find($taxis[0]->callcode->center_id);
    $title = $center->name.' - '.$center->telephone;
    return view('displayNew.demoPhp', compact('taxis', 'title'));
})->middleware('auth');
Route::get('api/display/{center_name}', function ($center_name) {
    $taxis = \App\Taxi::where('center_name', $center_name)->with('driver')->with('callcode')->get();
    return $taxis;
})->middleware('auth');
Route::get('/api/driver', function(Request $request) {
    $driver = \App\Driver::with('taxi')->find($request->id);
    $driver->paymentStatus = '<h4>Paid</h4>';
    return $driver;
})->middleware('auth');


/*
|--------------------------------------------------------------------------
|SMS Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'sms', 'middleware' => 'auth'], function () {
    Route::get('/', 'SmsController@index');
    Route::post('/', 'SmsController@send');

    Route::get('/group', 'GroupSmsController@index');
    Route::post('/group', 'GroupSmsController@store');

    Route::get('/group/status/{id}', 'GroupSmsController@status');
});

/*
|--------------------------------------------------------------------------
|Reports
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'report', 'middleware' => 'auth'], function () {
    Route::get('/driver', function () {
        $drivers = \App\Driver::all();
        return view('report.driver.index', compact('drivers'));
    });
    Route::get('/taxi', function () {
        $taxis = \App\Taxi::all();
        return view('report.taxi.index', compact('taxis'));
    });
    Route::get('/payment-history', function (Request $request) {
        if(request()->exists('to') AND request()->exists('from')) {
            $to = $request->input('to');
            $from = $request->input('from');
            $paids = \App\paymentHistory::where('paymentStatus', '1')
                                        ->whereBetween('created_at', array($from, $to))
                                        ->get();
        } else {
            $paids = \App\paymentHistory::where('paymentStatus', '1')->get();
        }
        return view('report.paymentHistory.index', compact('paids'));
    });
    Route::get('/payment-history-unpaid', function () {
        $taxis = \App\Taxi::all();
        return view('report.paymentHistoryUnpaid.index', compact('taxis'));
    });

    Route::get('/driving-school', function (Request $request) {
        if(request()->exists('to') AND request()->exists('from')) {
            $to = $request->input('to');
            $from = $request->input('from');
            $students = \App\DrivingS::whereBetween('created_at', array($from, $to))
                                        ->get();
        } else {
            $to = $request->input('to');
            $from = $request->input('from');
            $students = \App\DrivingS::whereBetween('created_at', array($from, $to))
            ->get();
        }
        return view('report.drivingschool.index', compact('students'));
    });
});

// Route::get('/voice-test', function () {
// })->middleware('auth');

Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
    Route::get('/all', function () {
        $users = \App\User::all();
        return view('user.index', compact('users'));
    });
});


Route::group(['prefix' => 'driving-school', 'middleware' => 'auth'], function () {
    Route::get('/', 'DrivingSController@index');

    Route::get('/create', 'DrivingSController@create');
    Route::post('/create/success', 'DrivingSController@store');

    Route::get('/students/{drivingS}', 'DrivingSController@show');

    Route::get('/students/{drivingS}/edit', 'DrivingSController@edit');
    Route::post('/students/{drivingS}/edit', 'DrivingSController@update');

});

Route::group(['prefix' => 'image-upload', 'middleware' => 'auth'], function () {
    // Taxi
    Route::post('/taxi_front/{id}', function (Request $request, $id) {
        $taxi = \App\Taxi::findOrFail($id);

        $photo = $request->image;
        $file_name = $photo->getClientOriginalName();
        $location = 'Taxi/'.$taxi->taxiNo.'/front';

        $url_original = Upload::upload_original($photo, $file_name, $location);
        $url_thumbnail = Upload::upload_thumbnail($photo, $file_name, $location);

        $taxi->taxi_front_url_o = $url_original;
        $taxi->taxi_front_url_t = $url_thumbnail;

        $taxi->save();

        return back()->with('alert-success', 'Photo updated');
    });
    Route::post('/taxi_back/{id}', function (Request $request, $id) {
        $taxi = \App\Taxi::findOrFail($id);

        $photo = $request->image;
        $file_name = $photo->getClientOriginalName();
        $location = 'Taxi/'.$taxi->taxiNo.'/back';

        $url_original = Upload::upload_original($photo, $file_name, $location);
        $url_thumbnail = Upload::upload_thumbnail($photo, $file_name, $location);

        $taxi->taxi_back_url_o = $url_original;
        $taxi->taxi_back_url_t = $url_thumbnail;

        $taxi->save();

        return back()->with('alert-success', 'Photo updated');
    });
    //Driver
    Route::post('/driver_photo/{id}', function (Request $request, $id) {
        $driver = \App\Driver::findOrFail($id);
        $taxi = \App\Taxi::findOrFail($driver->taxi_id);

        $photo = $request->image;
        $file_name = $photo->getClientOriginalName();
        $location = 'Taxi/'.$taxi->taxiNo.'/driver'.'/photo';

        $url_original = Upload::upload_original($photo, $file_name, $location);
        $url_thumbnail = Upload::upload_thumbnail($photo, $file_name, $location);

        $driver->driver_photo_url_o = $url_original;
        $driver->driver_photo_url_t = $url_thumbnail;

        $driver->save();

        return back()->with('alert-success', 'Photo updated');
    });
    Route::post('/li_front/{id}', function (Request $request, $id) {
        $driver = \App\Driver::findOrFail($id);
        $taxi = \App\Taxi::findOrFail($driver->taxi_id);

        $photo = $request->image;
        $file_name = $photo->getClientOriginalName();
        $location = 'Taxi/'.$taxi->taxiNo.'/driver'.'/licence'.'/front';

        $url_original = Upload::upload_original($photo, $file_name, $location);
        $url_thumbnail = Upload::upload_thumbnail($photo, $file_name, $location);

        $driver->li_front_url_o = $url_original;
        $driver->li_front_url_t = $url_thumbnail;

        $driver->save();

        return back()->with('alert-success', 'Photo updated');
    });
    Route::post('/li_back/{id}', function (Request $request, $id) {
        $driver = \App\Driver::findOrFail($id);
        $taxi = \App\Taxi::findOrFail($driver->taxi_id);

        $photo = $request->image;
        $file_name = $photo->getClientOriginalName();
        $location = 'Taxi/'.$taxi->taxiNo.'/driver'.'/licence'.'/back';

        $url_original = Upload::upload_original($photo, $file_name, $location);
        $url_thumbnail = Upload::upload_thumbnail($photo, $file_name, $location);

        $driver->li_back_url_o = $url_original;
        $driver->li_back_url_t = $url_thumbnail;

        $driver->save();

        return back()->with('alert-success', 'Photo updated');
    });
});

// Contatcts generation routes
Route::group(['prefix' => 'contacts-generate', 'middleware' => 'auth'], function () {
    Route::get('taxi', function() {
        // Taxi
        $taxis = \App\Taxi::where('active', '1')->where('taxiOwnerMobile', '!=', '-')->pluck('taxiOwnerMobile')->toArray();
        $taxi_numbers = Helper::validate_numbers($taxis);

        if (Helper::check_if_group_exists('All Taxi Owners')) {
            $taxi_group = \App\Contact::create([
                'group_name' => 'All Taxi Owners'
            ]);
        }
        else {
            $taxi_group = \App\Contact::where('group_name', 'All Taxi Owners')->first();
        }

        $numbers = $taxi_group->numbers;
        if (!$numbers->isEmpty()) {
            foreach ($numbers as $number) {
                $number->delete();
            }
        }

        foreach ($taxi_numbers as $number) {
            \App\PhoneNumbers::create([
                'number' => $number,
                'contact_id' => $taxi_group->id
            ]);
        }

        return $taxi_numbers;
    });
    Route::get('driver', function() {
        // Driver
        $drivers = \App\Driver::where('active', '1')->where('driverMobile', '!=', '-')->pluck('driverMobile')->toArray();
        $driver_numbers = Helper::validate_numbers($drivers);

        if (Helper::check_if_group_exists('All Drivers')) {
            $driver_group = \App\Contact::create([
                'group_name' => 'All Drivers'
            ]);
        }
        else {
            $driver_group = \App\Contact::where('group_name', 'All Drivers')->first();
        }

        $numbers = $driver_group->numbers;
        if (!$numbers->isEmpty()) {
            foreach ($numbers as $number) {
                $number->delete();
            }
        }

        foreach ($driver_numbers as $number) {
            \App\PhoneNumbers::create([
                'number' => $number,
                'contact_id' => $driver_group->id
            ]);
        }

        return $driver_numbers;
    });
    Route::get('students', function() {
        // Students
        $students = \App\DrivingS::where('phone', '!=', '-')->pluck('phone')->toArray();
        $student_numbers = Helper::validate_numbers($students);

        if (Helper::check_if_group_exists('All Driving School Students')) {
            $student_group = \App\Contact::create([
                'group_name' => 'All Driving School Students'
            ]);
        }
        else {
            $student_group = \App\Contact::where('group_name', 'All Driving School Students')->first();
        }

        $numbers = $student_group->numbers;
        if (!$numbers->isEmpty()) {
            foreach ($numbers as $number) {
                $number->delete();
            }
        }

        foreach ($student_numbers as $number) {
            \App\PhoneNumbers::create([
                'number' => $number,
                'contact_id' => $student_group->id
            ]);
        }

        return $student_numbers;
    });
    Route::get('server-time', function() {
        $mytime = Carbon::now();
        echo $mytime->toDateTimeString();
    });
});
// Contatcts generation routes

// Quiz
Route::group(['prefix' => 'theory', 'middleware' => 'auth'], function () {
    Route::get('/', function() {
        $quiz = \App\Quiz::with('questions')->findOrFail(1);
        return view('theory.index', compact('quiz'));
    });
    Route::post('/post', function(Request $request) {
        $quiz = \App\Quiz::with('questions')->findOrFail(1);
        $questions = $quiz->questions;

        $total_score = count($questions);
        $score = 0;

        foreach ($questions as $question) {
            $question_i = 'question-'.$question->id;
            $user_answer = $request->input($question_i);
            $correct_answer = $question->answers->where('is_correct', '1')->first();

            echo $question_i;
            echo '<br>';
            if ($user_answer == $correct_answer->id) {
                echo 'Answer is correct';
                $score++;

            } else {
                echo 'Answer is wrong, The correct answer is '.$correct_answer->answer;
            }
            echo '<br>';
            echo '--------------------------------';
            echo '<br>';
        }


        echo '<br>';
        echo 'Final Score is '. $score;
        echo '<br>';
        echo $score.' out of '.$total_score;

        if ($score == $total_score) {
            echo '<br>';
            echo 'Congratulations, Full Marks';
        }
    });

    Route::get('/add', function() {
        $quiz = \App\Quiz::with('questions')->findOrFail(1);
        $questions = $quiz->questions;
        return view('theory.add', compact('questions'));
    });
});

Route::get('/encrypt/{string}', function($string) {
    $encrypted = Crypt::encrypt($string);
    try {
        $decrypted = decrypt($encrypted);
        return $decrypted;
    } catch (DecryptException $e) {
        return $e;
    }
});

Route::get('new-payment-generation', function() {
    $now = Carbon::now();
    // dd($now);
    $next_month = $now->addMonth();
    $day = $now->day;
    $taxis = App\Taxi::all();

    // dd($next_month->month);

    function checkPaymentGeneration($month, $year) {
        $payments = paymentHistory::where('month', $month)->where('year', $year)->first();
        if ($payments){
            return true;
        } else {
            return false;
        }
    }

    // dd(checkPaymentGeneration($now->month, $now->year));
    // dd(checkPaymentGeneration($next_month->month, $next_month->year));

    function generatePayment($id, $month, $year) {
        App\paymentHistory::create([
            'taxi_id' => $id,
            'month' => $month,
            'year' => $year,
            'desc' => "Monthly Taxi Fee",
        ]);
        return true;
    }

    if ($day < 25) {
        if (checkPaymentGeneration($now->month, $now->year)) {
            
            return 'Payment Already generated for this month.';

        } else {
            echo 'Generating payment for this month. <br>';
            $now = Carbon::now();
            foreach ($taxis as $taxi) {
                generatePayment($taxi->id, $now->month, $now->year);
            }
            $taxiUp = App\Taxi::where('state', '1')->update(['state' => 0]);
            
            return 'Generated payment for this month';
        }

        return 'Before 25th';
    }
    elseif ($day == 25 or $day > 25) {
        $now = Carbon::now();
        if (checkPaymentGeneration($now->month, $now->year)) {

            if (checkPaymentGeneration($next_month->month, $next_month->year)) {

                return 'Payment generated for this and the next month.';

            } else {
                echo 'Payment already generated for this month, generating payment for next month. <br>';
                foreach ($taxis as $taxi) {
                    generatePayment($taxi->id, $next_month->month, $next_month->year);
                }
                $taxiUp = App\Taxi::where('state', '1')->update(['state' => 0]);

                return 'Generated payment for the next month';
            }

        } else {
            echo 'Generating payment for this month. <br>';
            $now = Carbon::now();
            // dd($now);
            // dd($next_month);
            foreach ($taxis as $taxi) {
                generatePayment($taxi->id, $now->month, $now->year);
            }
            $taxiUp = App\Taxi::where('state', '1')->update(['state' => 0]);
            
            return 'Generated payment for this month';

        }
        return '25 or later';
    }
});
