<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Encore\Admin\Form;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Tree;

class CategoryController extends Controller
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
            $content->header('分类树');
            $content->body(Category::tree());
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

            $content->header('分类管理');
            $content->description('修改分类');

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

            $content->header('分类管理');
            $content->description('创建分类');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function tree()
    {
        return Category::tree(function (Tree $tree){
            $tree->breanch(function ($branch){
                return "{$branch['id']} - {$branch['title']}";
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
        return Admin::form(Category::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', '分类名称')->rules('required|max:255|unique:categories');
            $form->select('parent_id', '父级分类')->options(Category::selectOptions());
            $states =[
                'on' => ['value' => '1', 'text' => '打开', 'color' => 'primary'],
                'off' => ['value' => '0', 'text' => '关闭', 'color' => 'default'],
            ];
            $form->switch('enabled', '是否显示')->states($states);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
