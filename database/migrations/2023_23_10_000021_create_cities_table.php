<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateWalletsTable
 */
class CreateWalletsTable extends Migration
{
  
    protected $table;

    public function __construct()
    {
        $this->table = config('handy.city.table', 'handy_cities');
    }

   
    public function up()
    {
        Schema::create($this->table, function(Blueprint $table)
        {
            $table->id();
            $table->string('name', 255);
            $table->unsignedBigInteger('province_id');
            $table->timestamps();
            $table->timestamps();
            $table->softDeletes();
        });
    }

  
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
