<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use CapstoneLogic\Stats\Model\Stats;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tablePrefix = config('capstonelogic.stats.db_prefix');

        Schema::create($tablePrefix.'stats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('key')->index();
            $table->integer('position')->default(0);
            $table->string('icon');
            $table->string('css_classes');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create($tablePrefix.'stats_counters', function (Blueprint $table) use ($tablePrefix) {
            $table->increments('id');
            $table->bigInteger('stats_id')->unsigned();
            $table->unsignedInteger('counter')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stats_id')->references('id')
                ->on($tablePrefix.'stats')->onDelete('cascade');
        });

        Stats::create([
            'title' => 'Visits',
            'key' => 'visits',
            'icon' => '<i class="fas fa-eye"></i>',
            'css_classes' => 'text-white bg-success',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tablePrefix = config('capstonelogic.stats.db_prefix');

        Schema::create($tablePrefix.'stats_counters', function (Blueprint $table) {
            $table->dropForeign('stats_id');
        });

        Schema::dropIfExists($tablePrefix.'stats_counters');
        Schema::dropIfExists($tablePrefix.'stats');
    }
}
