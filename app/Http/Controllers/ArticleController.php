<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            $query = Article::published();
        } else {
            $query = Article::query();
        }

        $articles = $query->with('images')->latest()->paginate(10);

        return view('articles.list', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|min:5',
            'author' => 'nullable|string|max:255',
            'content' => 'required',
        ]);
        $validated['author'] = $validated['author'] ?: 'Admin';

        $article = Article::create($validated);

        preg_match_all('/\[image_(\d+)\]/', $article->content, $matches);

        if (!empty($matches[0])) {
            $placeholders = $matches[0]; // [ "[image_1]", "[image_2]" ]

            ArticleImage::whereIn('placeholder', array_map(function ($ph) {
                return trim($ph, '[]'); // "[image_1]" → "image_1"
            }, $placeholders))->update(['article_id' => $article->id]);
        }

        return redirect()->route('articles.index')->with('success', 'Статья создана!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $article->update($request->only(['title', 'author', 'content']));

        preg_match_all('/\[image_(\d+)\]/', $article->content, $matches);
        $currentPlaceholders = array_map(function ($ph) {
            return trim($ph, '[]');
        }, $matches[0]);

        ArticleImage::whereIn('placeholder', $currentPlaceholders)
            ->update(['article_id' => $article->id]);

        $article->images()->whereNotIn('placeholder', $currentPlaceholders)->delete();

        return redirect(route('articles.show', ['article' => $article]))->with('success', 'Статья обновлена');
    }


    public function togglePublished(Article $article)
    {
        $article->published = !$article->published;
        $article->save();

        return response()->json([
            'status'    => 'success',
            'published' => $article->published,
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('articles', 'public');

        $placeholder = 'image_' . (ArticleImage::count() + 1);

        ArticleImage::create([
            'image_path'  => $path,
            'placeholder' => $placeholder,
            'article_id'  => null,
        ]);

        return response()->json([
            'placeholder' => "[$placeholder]"
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        foreach ($article->images as $image) {
            if (Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }
            $image->delete(); // удаляем запись из БД
        }

        $article->delete(); // удаляем статью

        return redirect()->route('articles.index')->with('success', 'Статья удалена');
    }
}
