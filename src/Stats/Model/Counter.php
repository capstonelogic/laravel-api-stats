<?php
namespace CapstoneLogic\Stats\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Counter extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'stats_id',
        'counter',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct(array $attributes = [])
    {
        $this->table = config('capstonelogic.stats.db_prefix') . 'stats_counters';
        parent::__construct($attributes);
    }

    /**
     * The roles that belong to the user.
     */
    public function stats()
    {
        return $this->hasOne(Stats::class);
    }
}
