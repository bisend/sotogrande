<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Page;
use App\Models\Admin\Language;
use App\Http\Helpers\Languages;

class PageController extends Controller
{
    public function index($alias, $language = Languages::DEFAULT_LANGUAGE)
    {
        Languages::localizeApp($language);

        // $page = 'page';
        // Get Static Data

        $languages = Language::all();

        $languageId = 1;

        foreach ($languages as $lang) {
            if ($lang->code == $language) {
                $languageId = $lang->id;
            }
        }
        // Get the Post
        $default_language = default_language();

        $static_data = static_home();
        
        $page = Page::with([
            'contentload' => function($query) use ($languageId) {
                $query->where('language_id', $languageId);
            },
        ])
        ->where('alias', $alias)
        ->first();

        if ($page) {
            $title = $page->contentload->title;

            $pages = Page::with([
                'contentload' => function ($query) use ($languageId) {
                    $query->where('language_id', $languageId);
                },
            ])
            ->where('status', 1)
            ->orderBy('position', 'asc')
            ->get();

        	return view('sotogrande.page', compact(
                'page', 
                'static_data',
                'pages',
                'language',
                'languages',
                'title'
            ));
        }else {
        	abort(404);
        }
    }
}
