<?php

namespace App\Console\Commands;

use App\Models\Duel;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RandomResult extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:random-result';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add random result to matches that were played in the last 24hrs.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $matches = Duel::whereNull(['team_home_score', 'team_away_score'])->where('match_date', '>=', Carbon::now()->subDays(1))->get();

        try {

            foreach ($matches as $match) {
                $homeTeamScore = rand(0, 5);
                $awayTeamScore = rand(0, 5);
    
                $match->update([
                    'is_played' => true,
                    'team_home_score' => $homeTeamScore,
                    'team_away_score' => $awayTeamScore,
                ]);
    
                $this->info('Added random result to matches that were played in the last 24hrs.');
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

    }
}
