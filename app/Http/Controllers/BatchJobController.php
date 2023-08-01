<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ImportCsv;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Throwable;

class BatchJobController extends Controller
{
    public function index(): void
    {
//        $batch = Bus::batch([
//            new ImportCsv(1, 100),
//            new ImportCsv(101, 200),
//            new ImportCsv(201, 300),
//            new ImportCsv(301, 400),
//            new ImportCsv(401, 500),
//        ])->then(function (Batch $batch) {
//            // All jobs completed successfully...
//        })->catch(function (Batch $batch, Throwable $e) {
//            // First batch job failure detected...
//        })->finally(function (Batch $batch) {
//            // The batch has finished executing...
//        })->dispatch();
//
//        return $batch->id;

//        Batch Naming
//        $batch = Bus::batch([
//            // ...
//        ])->then(function (Batch $batch) {
//            // All jobs completed successfully...
//        })->name('Import CSV')->dispatch();

        //Batch Connection & Queue
//        $batch = Bus::batch([
//            // ...
//        ])->then(function (Batch $batch) {
//            // All jobs completed successfully...
//        })->onConnection('redis')->onQueue('imports')->dispatch();
    }
}
