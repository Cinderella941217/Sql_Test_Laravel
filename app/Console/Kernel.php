<?php

namespace App\Console;

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
        $schedule->call(function(){
            $schedules = DB::table('schedules')->all();
            $conn = mysqli_connect(env('DB_HOST', 'localhost'), env('DB_USERNAME', 'forge'), env('DB_PASSWORD', ''), env('DB_DATABASE_SECOND', 'forge'));
            foreach ($schedules as $key => $schedule) {
                if($schedule->time == date('Y-m-d h:i:s')){
                    if ($conn->multi_query($schedule->query)) {
                        do {
                            $result = $conn->store_result();
                        } while ($conn->next_result());
                    }
                    $rlt = [];
                    if($result->num_rows){
                        while($row = $result->fetch_assoc()) {
                            array_push($rlt, $row);
                        }
                    }

                }
            }

        })->everyMinute();
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
