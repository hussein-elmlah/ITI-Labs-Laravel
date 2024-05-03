<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug', 255);
        });

        // Generate slugs based on title
        DB::statement("
            UPDATE posts
            SET slug = LOWER(
                REGEXP_REPLACE(
                    REGEXP_REPLACE(title, '^[^A-Za-z]+|[^A-Za-z]+$', '', 'g'),
                    '[^A-Za-z]+|(?<=[a-z])(?=[A-Z])', '\\-', 'g'
                )
            );
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
