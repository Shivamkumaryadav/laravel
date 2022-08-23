<?php

namespace App\Admin\Controllers;

use App\Models\Entry;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EntryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Entry';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Entry());

        $grid->column('id', __('Id'));
        $grid->column('first_name', __('First name'));
        $grid->column('last_name', __('Last name'));
        $grid->column('title', __('Title'));
        $grid->column('business_name', __('Business name'));
        $grid->column('type_of_operation', __('Type of operation'));
        $grid->column('distributor_name', __('Distributor name'));
        $grid->column('email', __('Email'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('optin', __('Optin'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Entry::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('first_name', __('First name'));
        $show->field('last_name', __('Last name'));
        $show->field('title', __('Title'));
        $show->field('business_name', __('Business name'));
        $show->field('type_of_operation', __('Type of operation'));
        $show->field('distributor_name', __('Distributor name'));
        $show->field('email', __('Email'));
        $show->field('phone_number', __('Phone number'));
        $show->field('optin', __('Optin'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Entry());

        $form->text('first_name', __('First name'));
        $form->text('last_name', __('Last name'));
        $form->text('title', __('Title'));
        $form->text('business_name', __('Business name'));
        $form->text('type_of_operation', __('Type of operation'));
        $form->text('distributor_name', __('Distributor name'));
        $form->email('email', __('Email'));
        $form->text('phone_number', __('Phone number'));
        $form->switch('optin', __('Optin'));

        return $form;
    }
}
