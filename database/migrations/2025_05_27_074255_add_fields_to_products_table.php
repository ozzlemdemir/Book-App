<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->string('author')->nullable();
        $table->string('type')->nullable();
        $table->year('publication_year')->nullable();
        $table->integer('page_count')->nullable();
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['author', 'type', 'publication_year', 'page_count']);
    });
}

};
