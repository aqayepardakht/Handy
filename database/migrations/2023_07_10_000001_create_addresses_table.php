<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
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
        $this->table = config('Handy.address.table', 'Handy_addresses');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('addressable_id')->index();
            $table->string('postal', 15)->nullable();
            $table->text('address')->nullable();
            $table->string('city', 20)->nullable();
            $table->string('taxcode', 10)->nullable();
            $table->string('telephone', 15)->nullable();
            $table->string('addressable_type', 255);
            $table->enum('type', ['home', 'office'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}