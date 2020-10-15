<?php
namespace GetThingsDone\Shareholder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shareholder extends Model
{
    use HasFactory;

    public function share_quantity_records()
    {
        return $this->hasMany(ShareQuantityRecord::class);
    }
}
