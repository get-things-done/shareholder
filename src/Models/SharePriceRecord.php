<?php
namespace GetThingsDone\Shareholder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharePriceRecord extends Model
{
    use HasFactory;
    
    protected $fillable = ['value'];
}
