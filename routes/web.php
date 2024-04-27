<?php

use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Ruhulfbr\CashApp\WebReceiptVerifier;
use Ruhulfbr\QueryGeneratorFromCsv\QueryGenerator;


Route::get('/', function () {
//    $collection = collect([1, 2, 3]);
//    dd($collection->where('0' , '>', '0')->all());

    $filePath = "example.csv";  // (String) Required, Absolute file path
    $createQuery = true; // (Boolean) Optional, set true if need to generate table create query, Default is FALSE;
    $tableName = "sobnar mdklsjd fjdsj"; // (String) Optional, If tableName not provided then csv filename will be the table name, Default is an empty string;

// With Named argument
// $generator = new QueryGenerator($filePath, _TABLE_NAME: "your_table_name");
// $generator = new QueryGenerator($filePath, _CREATE_QUERY: true);

// Together
    $generator = new QueryGenerator($filePath, $createQuery, $tableName);

    echo "<pre>";
    print_r($generator->generate());

    exit();

    $receipt = "https://cash.app/payments/3q5hwv6vpgs0stqymm6hp5byw/receipt?utm_source=activity-item";  // (String) Required, CashApp Web receipt;
    $username = "your_cash_app_username"; // (String) Required, CashApp Account Username;
    $reference = "your_payment_reference"; // (String) Required, CashApp Payment Reference;

    // With Named argument
    // $cashApp = new WebReceiptVerifier(_USERNAME: $username, _REFERENCE: $reference);

    // Together
    $cashApp = new WebReceiptVerifier($username, $reference);

    echo "<pre>";
    print_r($cashApp->verify($receipt));
    exit();



    return view('welcome');
});

Route::post('send-message',function (Request $request){
    event(new Message($request->username, $request->message));
    return ['success' => true];
});
