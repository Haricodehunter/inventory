<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\ImportStockin;
use Maatwebsite\Excel\Facades\Excel;



class ImportExcelController extends Controller
{
    function index()
    {
        $result = DB::table('stockins')->select('stockins.*')->get();
    //return view('import_excel', compact('result'));
     return view('import_excel', compact('result'));
    }

    // function import(Request $request)
    // {

    //     $request->validate([
    //         'import_file' => 'required'
    //     ]);

    //     $path = $request->file('import_file')->getRealPath();

    //     config(['excel.import.startRow' => 3]);
    //      Excel::import(new ImportStockin, request()->file('import_file'));
    //     return back()->with('success', 'Stocks imported successfully.');


    // //  $this->validate($request, [
    // //   'select_file'  => 'required|mimes:xls,xlsx'
    // //  ]);

    // //  $path = $request->file('select_file')->getRealPath();
    // // //  Excel::load() is removed and replaced by Excel::import($yourImport)
    // // //  Excel::create() is removed and replaced by Excel::download/Excel::store($yourExport)
    // // //  Excel::create()->string('xlsx') is removed an replaced by Excel::raw($yourExport, Excel::XLSX)
    // // $request->validate([
    // //     'import_file' => 'required'
    // // ]);
    // // Excel::import(new ImportStockin, request()->file('import_excel'));
    // // return back()->with('success', 'Contacts imported successfully.');


    // //   if(!empty($insert_data))
    // //   {
    // //    DB::table('stockin')->insert($insert_data);
    // //   }
    // //  }
    // //  return back()->with('success', 'Excel Data Imported successfully.');


    // }
    public function import(Request $request)
    {
        // $path = $request->file('excel')->getRealPath();
        $data = Excel::load($request->file('excel'))->get();

         if($data->count()){
            foreach ($data as $key => $value) {
                $arr[] = ['nama_barang' => $value->nama_barang];
            }

            if(!empty($arr)){
                return $arr;
            }
        }
    }
    public function importJson(Request $request)
    {
        //echo $request->jsonvalue;

        $resultjson = $request->jsonvalue;

        $objectVars = $resultjson;

        // echo $resultjson;

        // echo'<br/>';

        // echo  $objectVars;

        $someArray = json_decode($resultjson, true);
        // print_r($someArray);        // Dump all data of the Array
        // echo $someArray[0]["Sr No"]; // Access Array data

        // Convert JSON string to Object
        // $someObject = json_decode($resultjson);
        // print_r($someObject);      // Dump all data of the Object
        // echo $someObject[0]['Material Details'];

          foreach ( $someArray  as $result) {



            if( $result['Approved By']){


            $lotname =  $result['Material Details'];
            $categoryid= $this->getCategoryIds($result['Category']);
            $subcategoryid=  $this->getCategoryIds($result['Sub Category']);
            $apporvaldate=$result['Approved Date'];
            $apporvedby=$result['Approved By'];
            $apporved=$result['Approved'];
            $buildingname=$this->getCategoryIds($result['Building or Location']);
            $uniqtag=$this->randomNumber(3);
            $notes=$result['Notes'];

            $resultsss = DB::insert('insert into stockin( lotname, categoryid, subcategoryid, approvedby, approvaldate, buildingname, uniqtag, note) values (?, ?, ?, ?, ?, ?, ?, ?)', [$lotname, $categoryid, $subcategoryid, $apporvedby, $apporvaldate, $buildingname, $uniqtag,  $notes]);


            echo  $resultsss;
    //         if ($results != false) {
    //             return redirect('/stockin')->with('stockScsMsg', 'StockIn information save Successfully');
    //             //return redirect('/stockin')->with('stockScsMsg', $image);
    // //            $id = DB::getPdo()->lastInsertId();
    // //            echo $id;
    // //            return redirect('/invoice/' . $id);
    //         } else {
    //             return redirect('/stockin')->with('stockErrMsg', 'StockIn information save to Failed!!');
    //             //return redirect('/stockin')->with('stockScsMsg', $image);
    //         }

     }
        // foreach ($resultjson as $k => $value) {
        //     if(isset($value['Sheet1'])){
        //       $id    = $value['Sheet1'];
        //       echo  "<br/><br/>";
        //       echo  $id;
        //     }

        //   }

       // return back()->with('success', $request->jsonvalue)    ;
        }
    }


    public function randomNumber($length){
        $digits=null;
        $numbers = range(0,5);
        shuffle($numbers);
        for($i = 0;$i < $length;$i++)
           $digits .= $numbers[$i].date("Ymd");
        return $digits;
    }


    public function getCategoryIds($category){
        $categorylist = DB::table('category')->where('categoryname', $category)->first();
            //echo $categorylist;
        if($categorylist){
            return  $categorylist->id;
        } else {
            echo $category;
            $addCategory = DB::insert('insert into category(categoryname) values("'.$category.'")');
            $categorylist = DB::table('category')->where('categoryname', $category)->first();
            return  $categorylist->id;
        }
    }

    public function getSubCategoryIds($categoryiid, $subcategory){
        $subcategorylist = DB::table('subcategory')->where('subcategoryname', $subcategory)->first();
        if($subcategorylist){
            return  $categorylist->id;
        } else {
            $addCategory = DB::insert('insert into subcategory(pid, subcategoryname) values ('.$categoryiid.', '.$subcategory.')');
            $subcategorylist = DB::table('subcategory')->where('subcategoryname', $subcategory)->first();
            return  $subcategorylist->id;
        }
    }

    public function getbuildingIds($building){



            $buildinglist = DB::table('Buildings')->where('buildingsname', "'.$building.'")->first();
            if($buildinglist){
                return  $buildinglist->id;
            } else {

                $addCategory = DB::insert('insert into Buildings(buildingsname) values("'.$building.'")');
                $buildinglist = DB::table('Buildings')->where('buildingsname', "'.$building.'")->first();
                return  $buildinglist->id;
            }


    }

}
