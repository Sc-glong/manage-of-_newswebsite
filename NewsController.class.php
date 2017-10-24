<?php
namespace Admin\Controller;

class NewsController extends BaseController
{
    protected $table = 'newss';
    protected $cName = 'news';
    protected $headers = [];
    protected $fields = ['id', 'cid', 'title', 'content', 'add_time'];
}