<?php




namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Excel;

use App\stockin;

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

    public function categoryListapi()
    {

        $result = DB::table('category')->select('category.*')->get();
        return $result;
    }

    public function subcategoryListapi()
    {

        $result = DB::table('subcategory')->select('subcategory.*')->get();
        return $result;
    }


    public function buildingsListapi()
    {
        $result = DB::table('Buildings')->select('Buildings.*')->get();
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
            $stock = DB::table('stockin')
            ->join('registration', 'stockin.supid', '=', 'registration.id')
            ->join('category', 'stockin.categoryid', '=', 'category.id')
            ->join('subcategory', 'stockin.subcategoryid', '=', 'subcategory.id')
            ->join('Buildings', 'stockin.buildingname', '=', 'Buildings.id')
            ->select('stockin.*', 'registration.name', 'category.categoryname', 'subcategory.subcategoryname', 'Buildings.buildingsname')->where('stockin.id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($stock, 200);
          } else {
            return response()->json([
              "message" => "Student not found"
            ], 404);
          }
    }

    public function viewStockInUniq($uniqtag)
    {


        if (DB::table('stockin')->where('uniqtag', $uniqtag)->exists()) {
            $stock = DB::table('stockin')
            ->join('registration', 'stockin.supid', '=', 'registration.id')
            ->join('category', 'stockin.categoryid', '=', 'category.id')
            ->join('subcategory', 'stockin.subcategoryid', '=', 'subcategory.id')
            ->join('Buildings', 'stockin.buildingname', '=', 'Buildings.id')
            ->select('stockin.*', 'registration.name', 'category.categoryname', 'subcategory.subcategoryname', 'Buildings.buildingsname')->where('stockin.uniqtag', $uniqtag)->get()->toJson(JSON_PRETTY_PRINT);
            return response($stock, 200);
          } else {
            return response()->json([
              "message" => "Student not found"
            ], 404);
          }
    }
    public function viewStockInBuildingName($buildingname)
    {



            $stock = DB::table('stockin')
            ->join('registration', 'stockin.supid', '=', 'registration.id')
            ->join('category', 'stockin.categoryid', '=', 'category.id')
            ->join('subcategory', 'stockin.subcategoryid', '=', 'subcategory.id')
            ->join('Buildings', 'stockin.buildingname', '=', 'Buildings.id')
            ->select('stockin.*', 'registration.name', 'category.categoryname', 'subcategory.subcategoryname', 'Buildings.buildingsname')->where('Buildings.buildingsname', $buildingname)->get()->toJson(JSON_PRETTY_PRINT);
            return response($stock, 200);
        //   } else {
        //     return response()->json([
        //       "message" => "Student not found"
        //     ], 404);
        //   }
    }
    public function viewStockInBuildingId($buildingid)
    {



            $stock = DB::table('stockin')
            ->join('registration', 'stockin.supid', '=', 'registration.id')
            ->join('category', 'stockin.categoryid', '=', 'category.id')
            ->join('subcategory', 'stockin.subcategoryid', '=', 'subcategory.id')
            ->join('Buildings', 'stockin.buildingname', '=', 'Buildings.id')
            ->select('stockin.*', 'registration.name', 'category.categoryname', 'subcategory.subcategoryname', 'Buildings.buildingsname')->where('stockin.buildingname', $stockin)->get()->toJson(JSON_PRETTY_PRINT);
            return response($stock, 200);
        //   } else {
        //     return response()->json([
        //       "message" => "Student not found"
        //     ], 404);
        //   }
    }

    public function viewStockByCategory($categoryName)
    {



            $stock = DB::table('stockin')
            ->join('registration', 'stockin.supid', '=', 'registration.id')
            ->join('category', 'stockin.categoryid', '=', 'category.id')
            ->join('subcategory', 'stockin.subcategoryid', '=', 'subcategory.id')
            ->join('Buildings', 'stockin.buildingname', '=', 'Buildings.id')
            ->select('stockin.*', 'registration.name', 'category.categoryname', 'subcategory.subcategoryname', 'Buildings.buildingsname')->where('category.categoryname', $categoryName)->get()->toJson(JSON_PRETTY_PRINT);
            return response($stock, 200);
    }


    public function viewStockBysubCategory($subcategoryName)
    {

            $stock = DB::table('stockin')
            ->join('registration', 'stockin.supid', '=', 'registration.id')
            ->join('category', 'stockin.categoryid', '=', 'category.id')
            ->join('subcategory', 'stockin.subcategoryid', '=', 'subcategory.id')
            ->join('Buildings', 'stockin.buildingname', '=', 'Buildings.id')
            ->select('stockin.*', 'registration.name', 'category.categoryname', 'subcategory.subcategoryname', 'Buildings.buildingsname')->where('subcategory.subcategoryname',$subcategoryName)->get()->toJson(JSON_PRETTY_PRINT);
            return response($stock, 200);
    }

    public function updateapproveStockIn(Request $request, $id)
    {


        $approvedname =  $request->approvedby;
        $approvedate = date("m-d-y");

        echo $approvedname;

        $result = DB::update('update stockin set Approved = ?, approvaldate = ?, approvedby = ? where id = ?', [ 1, $approvedate, $approvedname, $id]);

         if ($result != false) {
            return response($stock, 200);
        } else {
            return response($stock, 300);


    }

}


public function createStockin(Request $request) {
    $stockin = new stockin;
    $stockin->name = $request->lotname;
    $stockin->categoryid = $request->category;
    $stockin->subcategoryid = $request->subcategory;
    $stockin->note = $request->note;
    $stockin->image = $request->image;
    $stockin->Approved = $request->approved;
    $stockin->approvaldate = $request->approvaldate;
    $stockin->approvedby = $request->approvedby;
    $stockin->buildingname = $request->buildingname;
    $stockin->uniqtag = $request->uniqtag;
    $stockin->save();
    return response()->json([
        "message" => "Stock record created"
    ], 201);

}

public function updateApprove(Request $request, $id) {
    if (stockin::where('id', $id)->exists()) {
        $stockin = stockin::find($id);
        $stockin->approved = is_null($request->approved) ? $stockin->approved : $request->approved;
        $stockin->approvedby = is_null($request->approvedby) ? $stockin->approvedby : $request->approvedby;
        $stockin->approvaldate = is_null($request->approvaldate) ? $stockin->approvaldate : date("m-d-y");
        $stockin->save();

        return response()->json([
            "message" => "records updated successfully"
        ], 200);
        } else {
        return response()->json([
            "message" => "Student not found"
        ], 404);

    }
}



}
