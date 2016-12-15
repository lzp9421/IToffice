<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\Report;
use App\Model\Classification;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test()
    {
//        $report = Report::all();
//        dd($report[0]->Classification);
        $classification = Classification::first();
        dd($classification->Reports);
    }


}
