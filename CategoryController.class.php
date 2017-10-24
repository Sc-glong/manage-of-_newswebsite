<?php
namespace Admin\Controller;

class CategoryController extends BaseController
{
    protected $table = 'categorys';
    protected $cName = 'category';
    protected $headers = ['id', '新闻分类', '排序位', '是否显示'];
    protected $fields = ['id', 'name', 'sorder', 'isshow'];
}