<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPortfolios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->text('project_overview')->nullable();
            $table->string('coding')->nullable();
            $table->string('design')->nullable();
            $table->string('responsibilities')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn('project_overview');
            $table->dropColumn('coding');
            $table->dropColumn('design');
            $table->dropColumn('responsibilities');
        });
    }
}
