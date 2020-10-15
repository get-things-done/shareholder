<?php

namespace GetThingsDone\Shareholder\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use GetThingsDone\Shareholder\Models\SharePriceRecord;


class SharePriceRecordFactory extends Factory
{
    protected $model = SharePriceRecord::class;

    public function definition()
    {
        return [
            'value' => rand()
        ];
    }
}

