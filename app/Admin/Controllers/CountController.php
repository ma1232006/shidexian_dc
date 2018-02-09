<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Title;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;

class CountController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('统计');

            $titles = Title::where('type', 1)->get();

            $content->body(view('count', compact('titles')));
        });
    }
}
