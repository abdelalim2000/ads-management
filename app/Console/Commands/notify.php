<?php

namespace App\Console\Commands;

use App\Mail\NotifyAdvertiser;
use App\Models\Advertiser;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'advertiser:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to all advertiser to notify them about the ads start date';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Advertiser::query()
            ->whereHas('ads', function ($query) {
                $query->whereDate('start_date', '=', Carbon::tomorrow());
            })->chunk(25, function ($advertiser) {
            foreach ($advertiser as $item) {
                Mail::to($item->email)->send(new NotifyAdvertiser());
            }
        });

        return Command::SUCCESS;
    }
}
