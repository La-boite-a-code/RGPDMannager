<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTermsIcon extends Migration
{
    public function up()
    {
        Schema::table('terms', function(Blueprint $table) {
            $table->string('icon')->nullable()->after('slug');
        });
    }

    public function down()
    {
        Schema::table('terms', function(Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
}