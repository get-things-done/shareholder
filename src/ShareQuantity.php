<?php
namespace GetThingsDone\Shareholder;

use GetThingsDone\Shareholder\Models\Shareholder;
use GetThingsDone\Shareholder\Models\ShareQuantityRecord;

class ShareQuantity
{
    protected Shareholder $shareholder;
    
    public function __construct(Shareholder $shareholder)
    {
        $this->shareholder = $shareholder;
    }

    public function of(Shareholder $shareholder): self
    {
        $this->shareholder = $shareholder;

        return $this;
    }
    
    public function current(): int
    {
        return $this->shareholder
                ->share_quantity_records()
                ->orderBy('id', 'desc')->first()
                ->balance ?? 0;
    }

    public function create(int $value): ShareQuantityRecord
    {
        return $this->shareholder
                ->share_quantity_records()
                ->create(compact('value'));
    }

    public function increase(int $value): ShareQuantityRecord
    {
        if ($value < 0) {
            throw new \InvalidArgumentException();
        }
            
        return $this->create($value);
    }

    public function decrease(int $value): ShareQuantityRecord
    {
        if ($value < 0) {
            throw new \InvalidArgumentException();
        }
            
        return $this->create(0 - $value);
    }
}
