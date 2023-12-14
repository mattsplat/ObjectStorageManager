<?php

namespace App\Http\Controllers;

use App\Events\DialogHasProcessed;
use Illuminate\Http\Request;
use Native\Laravel\Dialog;
use Native\Laravel\Facades\Clipboard;

class NativeController extends Controller
{

    public function dialog(Request $request)
    {
        $dialog = Dialog::new();
        if($request->folders) {
            $dialog->folders();
        }

        $dialog = Dialog::new();

        /**
         * @var boolean $folders
         */
        if($request->folders) {
            $dialog->folders();
        }

        /**
         * @var string $title
         */
        if($request->title) {
            $dialog->title($request->title);
        }

        /**
         * @var string $button
         */
        if($request->button) {
            $dialog->button($request->button);
        }

        /**
         * @var boolean $multiple
         */
        if($request->multiple) {
            $dialog->multiple();
        }

        /**
         * @var array $filters
         *
         */
        if($request->filters) {
            foreach($request->filters as $key => $filter) {
                $dialog->filter($key, $filter);
            }
        }

        /**
         * @var boolean $asSheet
         */
        if($request->asSheet) {
            $dialog->asSheet();
        }

        /**
         * @var boolean $withHiddenFiles
         */
        if($request->withHiddenFiles) {
            $dialog->withHiddenFiles();
        }

        /**
         * @var array<string> $properties
         */
        if($request->properties) {
            $dialog->properties($request->properties);
        }


        return $dialog->open();
    }

    public function clipboard(Request $request)
    {
        return match($request->type) {
            'text' => Clipboard::text($request->data),
            'html' => Clipboard::html($request->data),
            'image' => Clipboard::image($request->data),
            default => null,
        };
    }
}
