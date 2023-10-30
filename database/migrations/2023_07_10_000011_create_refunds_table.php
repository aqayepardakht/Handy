<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateWalletsTable
 */
class CreateWalletsTable extends Migration
{
    /**
     * Table names.
     *
     * @var string  $table  The main table name for this migration.
     */
    protected $table;

    /**
     * Create a new migration instance.
     */
    public function __construct()
    {
        $this->table = config('handy.refund.table', 'handy_refunds');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function(Blueprint $table)
        {
            $table->id();
            $table->unsignedBigInteger('transaction_id')->index();
            $table->string('trace_code')->nullable();
            $table->decimal('amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
