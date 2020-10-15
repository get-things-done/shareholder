<?php
namespace GetThingsDone\Shareholder;

use GetThingsDone\Shareholder\Models\SharePriceRecord;

class SharePrice
{
    public SharePriceRecord $model;

    public function __construct(SharePriceRecord $model)
    {
        $this->model = $model;
    }

    public function current(): int
    {
        return $this->model->orderBy('id', 'desc')->first()->value ?? 0;
    }

    public function update(int $value): void
    {
        $this->model->create(compact('value'));
    }
}
