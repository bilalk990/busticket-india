<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationController extends Controller
{
    public function translate(Request $request)
    {
        $text = $request->input('text');
        $targetLanguage = $request->input('targetLanguage');

        try {
            $translator = new GoogleTranslate();
            $translator->setTarget($targetLanguage);
            $translatedText = $translator->translate($text);

            return response()->json(['translatedText' => $translatedText]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Translation failed'], 500);
        }
    }
}
