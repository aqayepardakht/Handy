<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateWalletsTable
 */
class CreateInvoicesTable  extends Migration
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
        $this->table = config('Handy.payment.table', 'Handy_invoices');
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
            $table->unsignedBigInteger('payable_id');
            $table->string('payable_type');
            $table->string('trace_code');
            $table->string('tracking_number')->nullable();
            $table->float('amount');
            $table->string('card_numbers')->nullable();
            $table->string('product_id')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('description')->nullable();
            $table->enum('status', ['created', 'paid', 'unpaid', 'pending_verify'])->default('created');
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
