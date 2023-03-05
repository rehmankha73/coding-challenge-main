<?php

use App\Constants\RequestType;
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
    public function up()
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_from')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('user_to')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('status')
                ->default(RequestType::COMPLETED);

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
        Schema::dropIfExists('connections');
    }
};
