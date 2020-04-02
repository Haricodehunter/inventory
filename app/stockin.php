<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stockin extends Model
{
    protected $table = 'stockin';
    protected $fillable = [
        'lotname', 'note', 'image', 'Approved', 'approvaldate', 'approvedby', 'categoryid', 'subcategoryid', 'buildingname', 'uniqtag'
    ];
}
