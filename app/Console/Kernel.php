<?php

namespace App\Console;

use App\Moyo;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

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
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        try {
            $schedule->call(function () {
                set_time_limit(600);
                $moyo = new Moyo();
                $data = $moyo->getData();
                $cats = $moyo->getCategories($data);
                DB::table('categories')->insertOrIgnore($cats);

                $offers = $moyo->getOffers($data);
                foreach (array_chunk($offers, 3000) as $value) {
                    DB::table('products')->insertOrIgnore($value);
                }
            })->hourly();
        } catch (Exception $exceptione) {
            Log::info('Ошибка ======> ' . $exceptione);
        }

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
