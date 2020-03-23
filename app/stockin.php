<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stockin extends Model
{
    protected $fillable = [
        'lotname', 'note', 'image', 'approved', 'approvaldate', 'approvedby', 'categoryid', 'subcategoryid', 'buildingname', 'uniqtag'
    ];
}
