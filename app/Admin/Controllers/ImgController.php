<?php

namespace App\Admin\Controllers;

use App\Models\Img;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ImgController extends Controller
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

            $content->header('header');
            $content->description('description');

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

            $content->header('header');
            $content->description('description');

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

            $content->header('header');
            $content->description('description');

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
        return Admin::grid(Img::class, function (Grid $grid) {

            $grid->id('ID');
            $grid->column('title', '图片简介');
            $grid->column('img', '图片')->image('', 100, 100);
            $grid->column('weight', '权重')->sortable();
            $grid->column('enabled', '是否显示')->switch();
            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Img::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', '图片简介')->rules('required|max:255');
            $form->image('img', '商品图片')->uniqueName()
                ->move('imgs')->rules('required');
            $form->number('weight', '权重')->rules('required');
            $states =[
                'on' => ['value' => '1', 'text' => '显示', 'color' => 'primary'],
                'off' => ['value' => '0', 'text' => '隐藏', 'color' => 'default'],
            ];
            $form->switch('enabled', '是否显示')->states($states);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

}
