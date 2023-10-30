<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $table;

    /**
     * Create a new migration instance.
     */
    public function __construct()
    {
        $this->table = config('handy.ticket.table', 'handy_tickets');
    }

    public function up()
    {
        Schema::create($this->table , function (Blueprint $table) {
            $table->id();
            $table->string('title');  
            $table->enum('department' , ['financial' , 'general' , 'technical']);
            $table->enum('priority' , ['low' , 'medium' , 'high']);
            $table->enum('status' , ['waiting' , 'pending' , 'answered' , 'closed' , 'customerResponse']);
            $table->enum('satisfaction' , ['happy' , 'unhappy'])->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->string('opts');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
