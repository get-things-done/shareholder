<?php
namespace GetThingsDone\Shareholder;

use GetThingsDone\Shareholder\Models\Shareholder;
use GetThingsDone\Shareholder\Models\ShareQuantityRecord;

class ShareQuantity
{
    protected ShareQuantityRecord $model;

    protected Shareholder $shareholder;
    
    public function __construct(ShareQuantityRecord $model, Shareholder $shareholder)
    {
        $this->model = $model;
        $this->shareholder = $shareholder;
    }

    public function setShareholder(Shareholder $shareholder): self
    {
        $this->shareholder = $shareholder;

        return $this;
    }
    
    public function getCurrentQuantity(): int
    {
        return $this->shareholder
                ->share_quantity_records()
                ->orderBy('id', 'desc')->first()
                ->balance ?? 0;
    }

    public function createQuantityRecord(int $value): ShareQuantityRecord
    {
        return $this->shareholder
                ->share_quantity_records()
                ->create(compact('value'));
    }
}
