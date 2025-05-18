<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('articles', 'slug')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->string('slug')->after('title')->default('temp');
            });

            $articles = \App\Models\Article::all();

            foreach ($articles as $article) {
                $slug = Str::slug($article->title);
                $article->slug = $slug;
                $article->save();
            }

            Schema::table('articles', function (Blueprint $table) {
                $table->string('slug')->nullable(false)->default(null)->change();
                $table->unique('slug');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('articles', 'slug')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
    }
};
