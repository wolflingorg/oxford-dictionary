<?php

namespace App\Http\Controllers;

use App\System\Oxford\v2\Dictionary;
use App\System\Oxford\v2\DictionaryException;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $word = $request->get('q');
        $error = null;
        $results = [];

        if (empty($word)) {
            abort(404);
        }

        /** @var Dictionary $dictionary */
        $dictionary = app(Dictionary::class);

        try {
            $results = $dictionary->entries('en-gb', $word);
        } catch (DictionaryException $e) {
            $error = $e->getMessage();
        }

        return view('pages.search', [
            'word' => $word,
            'results' => $results,
            'error' => $error,
        ]);
    }
}
