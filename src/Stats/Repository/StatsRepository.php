<?php
namespace CapstoneLogic\Stats\Repository;

use Carbon\Carbon;
use Woodoocoder\LaravelHelpers\DB\Repository;
use CapstoneLogic\Stats\Model\Stats;

class StatsRepository extends Repository {
    
    private $today;

    /**
     * @param Collection $collection
     */
    public function __construct(Stats $stats) {
        parent::__construct($stats);

        $this->today = Carbon::now();
    }

    /**
     * @param array $attributes
     * @param int $id
     * 
     * @return LengthAwarePaginator
     */
    public function counters($fromDay = null, $toDate = null) {
        $fromDate   = ($fromDay === null) ? $this->today : Carbon::parse($fromDay);
        $toDate     = ($toDate === null) ? $this->today : Carbon::parse($toDate);
        
        $query = $this->model->query();
        $query->with(['counters' => function($query) use ($fromDate, $toDate) {
            $query->whereDate('updated_at', '>=', $fromDate->format('Y-m-d 00:00:00'));
            $query->whereDate('updated_at', '<=', $toDate->format('Y-m-d 23:59:59'));
        }]);
        
        return $query->paginate();
    }

    /**
     * @param string $key
     * 
     */
    public function increment($key) {
        $today = $this->today;

        $query = $this->model->query();
        $stats = $query->with(['counters' => function($query) use ($today) {
            $query->whereDate('updated_at', $today->format('Y-m-d'));
        }])->where('key', $key)->first();

        if($stats) {
            if($stats->counters->count() === 0) {
                $stats->counters()->create(['counter' => 1]);
            } else {
                $stats->counters[0]->increment('counter');
            }
        }
    }
}
