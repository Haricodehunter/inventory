<?php

namespace App\Imports;
use DB;
use App\stockin;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportStockin implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null

    */
    public $count = 0;
       /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {

        $categoryid = $this->getCategoryIds(@$row[3]);
        // if( $categoryid ){
        //     $subcategoryid = $this->getSubCategoryIds($categoryid, @$row['sub category']);
        // }
      if(@$row[5] != "Building or Location"){

    //         $buildingname = $this->getbuildingIds(@$row[5]);
         $uniqtag = $this->randomNumber(2);
        //  echo $row[1];
        //  echo $row[1];
        //  echo $row[2];
        if( @$row[4]!=null && @$row[5]!=null){

            return new stockin([
                'lotname'  => @$row[1],
                'categoryid'  => @$row[3],
                'subcategoryid'  => @$row[4],
                'approved'    => @$row[8],
                'approvedby'    => @$row[6],
                'approvaldate'  => @$row[7],
                'buildingname'   => @$row[5],
                'image'   => @$row[2],
                'uniqtag'   =>  $uniqtag,
                'note'   => @$row[9],
            ]);
        }

    }
    }

    // public function rules(): array
    // {
    //     return [
    //         // '1' => Rule::in(['patrick@maatwebsite.nl']),

    //         //  // Above is alias for as it always validates in batches
    //         //  '*.1' => Rule::in(['patrick@maatwebsite.nl']),

    //          // Can also use callback validation rules
    //          '3' => function($value) {
    //               if ($value != null) {
    //                 $categorylist = DB::table('category')->where('categoryname', $value)->first();
    //                         echo $categorylist;
    //                     if($categorylist->id){
    //                         return  $categorylist->id;
    //                     } else {
    //                         echo $category;
    //                         $addCategory = DB::insert('insert into category(categoryname) values("test ")');

    //                     }
    //               }
    //           }
    //     ];
    // }

    public function randomNumber($length){
        $digits=null;
        $numbers = range(0,5);
        shuffle($numbers);
        for($i = 0;$i < $length;$i++)
           $digits .= $numbers[$i].date("Ymd");
        return $digits;
    }


    // public function getCategoryIds($category){
    //     $categorylist = DB::table('category')->where('categoryname', $category)->first();
    //         echo $categorylist;
    //     if($categorylist['id']){
    //         return  $categorylist['id'];
    //     } else {
    //         echo $category;
    //         $addCategory = DB::insert('insert into category(categoryname) values("test ")');
    //         $this -> getCategoryIds($category);
    //     }
    // }

    // public function getSubCategoryIds($categoryiid, $subcategory){
    //     $subcategorylist = DB::table('subcategory')->where('subcategoryname', $subcategory)->first();
    //     if($subcategorylist['id']){
    //         return  $categorylist['id'];
    //     } else {
    //         $addCategory = DB::insert('insert into subcategory(pid, subcategoryname) values ('.$categoryiid.', '.$subcategory.')');
    //         $this -> getCategoryIds($subcategory);
    //     }
    // }

    // public function getbuildingIds($building){



    //         $buildinglist = DB::table('Buildings')->where('buildingsname', "'.$building.'")->first();
    //         if($buildinglist){
    //             return  $buildinglist;
    //         } else {

    //             $addCategory = DB::insert('insert into Buildings(buildingsname) values("'.$building.'")');
    //             $buildinglist = DB::table('Buildings')->where('buildingsname', "'.$building.'")->first();
    //             return  $buildinglist;
    //         }


    //}
}
