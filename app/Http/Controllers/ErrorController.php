<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Languages;

/**
 * Class ErrorController
 * @package App\Http\Controllers
 */
class ErrorController extends Controller
{
    /**
     * show error page
     * @param $error
     * @param string $language
     * @return mixed
     */
    public function index($error, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new ErrorViewModel('error', $language, $error);

        $this->errorService->fill($model);

        return response()->view("errors.$error", compact('model'), $error);
    }
}
