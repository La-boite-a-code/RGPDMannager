<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsentsTable extends Migration
{
    public function up()
    {
        Schema::create('consents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('token');
            $table->string('form_id');
            $table->string('form_url');
            $table->string('purpose');
            $table->string('data_used');
            $table->text('explanation')->nullable();
            $table->enum('action', ['consent', 'refuse'])->default('consent');
            $table->unsignedBigInteger('user_id')->index()->nullable()->default(null);
            $table->timestamps();
        });

        Schema::table('consents', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('consents', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('consents');
    }
}