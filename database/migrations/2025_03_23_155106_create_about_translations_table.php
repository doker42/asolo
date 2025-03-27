<?php

declare(strict_types=1);

use App\Models\About;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('about_translations', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(About::class, 'item_id')
                ->constrained('abouts')
                ->cascadeOnDelete();

            $table->string('locale');

            $table->string('about')->nullable();

            $table->unique(['item_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_translations');
    }
};
