<?php
namespace GetThingsDone\Shareholder\Models;

use Illuminate\Database\Eloquent\Model;

class ShareTranferRecord extends Model
{
    public $fillable = [
        'from_record_id','to_record_id',
    ];

    public function from_record()
    {
        return $this->hasOne(ShareQuantityRecord::class, 'from_record_id');
    }

    public function to_record()
    {
        return $this->hasOne(ShareQuantityRecord::class, 'to_record_id');
    }
}
