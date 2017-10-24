<?php
/**
 * Created by PhpStorm.
 * User: ll
 * Date: 2017/10/15
 * Time: 19:37
 */

namespace Admin\Controller;

class UsersController extends BaseController
{
    protected $table='users';
    protected $cName='users';
    protected $headers = [];
    protected $fields = ['id', 'username', 'password', 'email','image', 'add_time'];

}