<?php
namespace GetThingsDone\Shareholder\Database\Factories;

use GetThingsDone\Shareholder\Models\Shareholder;
use Illuminate\Database\Eloquent\Factories\Factory;
use GetThingsDone\Shareholder\Models\ShareQuantityRecord;

class ShareQuantityRecordFactory extends Factory
{
    protected $model = ShareQuantityRecord::class;

    public function definition()
    {
        return [
            'shareholder_id' => Shareholder::factory(),
            'value' => rand(-100000,100000)
        ];
    }
}