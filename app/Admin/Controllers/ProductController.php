<?php

namespace App\Admin\Controllers;

use App\Models\Product;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ProductController extends Controller
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

            $content->header('商品管理');
            $content->description('商品列表');

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

            $content->header('商品管理');
            $content->description('修改商品信息');

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

            $content->header('商品管理');
            $content->description('创建商品');

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
        return Admin::grid(Product::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('title', '商品标题');
            $grid->column('price', '价格');
            $grid->column('number', '库存数量');
            $grid->column('img','商品图片')->value(function ($img){
                return json_decode($img, true);
            })->image('', 100, 100);
            $grid->column('description', '描述')->limit(30);
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
        return Admin::form(Product::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', '商品标题')->rules('required|max:255|unique:products');
            $form->number('number', '库存数量')->rules('required');
            $form->number('price', '价格')->rules('required');
            $form->image('img', '商品图片')->multiple()->uniqueName()
                ->move('public/upload/product')->rules('required');
            $form->editor('description', '描述');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
