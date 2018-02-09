<?php

namespace App\Admin\Controllers;

use App\MemberAnswer;

use App\Title;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AnswerTextCountController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('统计');

            $titles = Title::where('type', 1)->get();

            $content->body(view('answer-text', compact('titles')));
        });
    }
}
