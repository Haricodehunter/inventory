<?php




namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;


class StockController extends Controller
{
    //

    // public function __construct()
    // {
    //     $this->middleware('auth:api')->except(['index', 'show']);
    // }

    public function index()
    {
        $stock = DB::table('stockin') ->get();
        return  $stock;
    }

    public function stockInListapi()
    {
           
        $result = DB::table('stockin')
                ->join('registration', 'stockin.supid', '=', 'registration.id')
                ->join('category', 'stockin.categoryid', '=', 'category.id')
                ->join('subcategory', 'stockin.subcategoryid', '=', 'subcategory.id')
                ->select('stockin.*', 'registration.name', 'category.categoryname', 'subcategory.subcategoryname')
                ->get();
            return $result;
    }

}
