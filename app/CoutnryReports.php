<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryReports extends Model
{
    protected $table = 'country_report';

    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    protected $fillable = [
        'data'      
    ];
}
