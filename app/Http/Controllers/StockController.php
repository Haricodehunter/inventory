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
                ->join('Buildings', 'stockin.buildingname', '=', 'Buildings.id')
                ->select('stockin.*', 'registration.name', 'category.categoryname', 'subcategory.subcategoryname', 'Buildings.buildingsname')
                ->get();
            return $result;
    }

    public function viewStockIn($id)
    {
       
        $stockInData = DB::table('stockin')->where('uniqtag', $id)->first();
        $suppliersData = DB::select('select * from registration');
        $categoryData = DB::table('category')->get();
        $subcategoryData = DB::table('subcategory')->get();
        $buildingData = DB::table('Buildings')->get();

        if (DB::table('stockin')->where('id', $id)->exists()) {
            $stock = DB::table('stockin')->where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($stock, 200);
          } else {
            return response()->json([
              "message" => "Student not found"
            ], 404);
          }
    }

   

}
