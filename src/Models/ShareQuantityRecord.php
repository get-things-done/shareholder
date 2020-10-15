<?php
namespace GetThingsDone\Shareholder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareQuantityRecord extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'value', 'shareholder_id',
    ];

    public function getBalanceAttribute()
    {
        return $this->where('shareholder_id', $this->shareholder_id)
                ->where('id', '<=', $this->id)
                ->sum('value');
    }
}
