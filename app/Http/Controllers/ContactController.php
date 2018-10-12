<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin\Page;
use App\Models\Admin\Language;
use App\Http\Helpers\Languages;

class ContactController extends Controller
{
    protected $static_data, $default_language;

    public $languages;

    public function __construct() 
    {
        $this->static_data = static_home();

        $this->default_language = default_language();
    }

    public function index($language = Languages::DEFAULT_LANGUAGE)
    {
        Languages::localizeApp($language);

        $page = 'contact';
        // Get Static Data
        $static_data = $this->static_data;

        $default_language = $this->default_language;

        $languages = Language::all();

        $languageId = 1;

        foreach ($languages as $lang) {
            if ($lang->code == $language) {
                $languageId = $lang->id;
            }
        }

        $title = 'Contact | Ayling';

        $pages = Page::with([
            'contentload' => function ($query) use ($languageId) {
                $query->where('language_id', $languageId);
            },
        ])
        ->where('status', 1)
        ->orderBy('position', 'asc')
        ->get();

        return view('sotogrande.contact', compact(
            'static_data', 
            'default_language', 
            'title',
            'pages',
            'page',
            'language',
            'languages',
            'languageId'
        ));
    }
}
