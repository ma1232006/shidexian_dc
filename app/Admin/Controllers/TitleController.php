<?php

namespace App\Admin\Controllers;

use App\Title;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class TitleController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('题目');
            $content->description('列表');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('题目');
            $content->description('编辑');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('题目');
            $content->description('添加');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Title::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->title('题目名称');
            $grid->column('type', '题目类型')->display(function ($type) {
                $typeSelect = [
                    1   =>  '单选题目',
                    2   =>  '留言内容',
                ];
                return $typeSelect[$type];
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Title::class, function (Form $form) {
            $form->text('title', '题目名称')->rules('required');

            $type = [
                1   =>  '单选题目',
                2   =>  '留言内容',
            ];
            $form->select('type', '题目类型')->options($type)->rules('required');
        });
    }
}
