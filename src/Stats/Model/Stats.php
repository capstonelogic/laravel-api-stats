<?php
namespace CapstoneLogic\Stats\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stats extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'title',
        'key',
        'position',
        'icon',
        'css_classes'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct(array $attributes = [])
    {
        $this->table = config('capstonelogic.stats.db_prefix') . 'stats';
        parent::__construct($attributes);
    }

    /**
     * The roles that belong to the user.
     */
    public function counters()
    {
        return $this->hasMany(Counter::class);
    }
}
