<?php

namespace GetThingsDone\Shareholder\Commands;

use Illuminate\Console\Command;

class ShareholderCommand extends Command
{
    public $signature = 'shareholder';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
