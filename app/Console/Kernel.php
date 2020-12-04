<?php

namespace App\Console;

use App\Moyo;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
//        $schedule->call('\Fresh\Medpravda\Repositories\SitemapRepository@getMedicines')->dailyAt('01:30');


        $schedule->call(function () {
            $moyo = new Moyo();
            $data = $moyo->getData();
            $cats = $moyo->getCategories($data);
            DB::table('categories')->insertOrIgnore($cats);
        })->dailyAt('21:40');


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
