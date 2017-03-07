<?php

namespace App\Admin\Controllers;

use App\Models\Activity;
use App\Models\Product;
use App\Models\Category;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ActivityController extends Controller
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

            $content->header('拼团活动');
            $content->description('活动列表');

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

            $content->header('拼团活动');
            $content->description('修改信息');

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

            $content->header('拼团活动');
            $content->description('创建活动');

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
        return Admin::grid(Activity::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('title', '拼团标题');
            $grid->column('pt_price', '拼团价格');
            $grid->column('pt_number', '拼团人数')->editable();
            $grid->column('over_time', '结束时间');
            $grid->column('weight', '权重')->sortable()->editable();
            $grid->column('status', '上架')->switch();
            $grid->category()->title('分类');
            $grid->column('img_index', '拼团主图')->image('', 100, 100);
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
        return Admin::form(Activity::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', '拼团标题')->rules('required|unique:activities');
            $form->currency('pt_price', '拼团价格')->symbol('¥')->rules('required');
            $form->number('pt_number', '拼团人数')->rules('required');
            $form->date('over_time', '结束时间')->rules('required');
            $form->number('weight', '权重')->rules('required');
            $states = [
                'on' => ['value' => 1, 'text' => '上架', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '下架', 'color' => 'danger'],
            ];
            $form->switch('status', '是否上架')->states($states);
            $form->image('img', '商品图片')->uniqueName()
                ->move('public/upload/pintuan')->rules('required');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
