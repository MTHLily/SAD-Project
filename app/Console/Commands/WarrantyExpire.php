<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class WarrantyExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'warranty:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks all warranties and see if they have expired';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach ( \App\Warranty::all() as $warranty ) {
            if ($warranty->warranty_life->lt(Carbon::now())) {
                $warranty->status = "Expired";
                $warranty->save();
            }
        }
    }
}
