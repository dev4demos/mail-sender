<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSenderTable extends Migration
{
    const TABLE_MESSAGES = 'messages';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::hasTable(self::TABLE_MESSAGES) ?: Schema::create(self::TABLE_MESSAGES, function (Blueprint $table) {
            $owner = 'user_id';

            $table->bigIncrements('id');
            $table->string('uid', 150)->nullable()->unique();
            $table->text('content')->nullable();
            $table->string('sender', 100)->nullable();
            $table->boolean('sent')->default(1);
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
        Schema::dropIfExists(self::TABLE_MESSAGES);
    }
}
