<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Model;

class BaseController extends Controller
{
    protected $db = null;
    protected $table = '';
    protected $cName = '';  // 当前控制器名称
    protected $headers = [];    // 表格表头
    protected $fields = [];     // 数据表字段

    // 初始化方法，每个动作会自动调用该方法
    public function _initialize()
    {
        $this->db = new Model($this->table);
        $this->assign('headers', $this->headers);
        $this->assign('$this->fields', $this->fields);
    }

    // 显示所有记录
    public function index()
    {
        // 1. 获取所有记录
        $results = $this->db->select();
        // 2. 交给视图
        $this->assign('results', $results);
        // 3. 显示视图
        $this->display();
    }

    // 显示添加记录表单
    public function create()
    {
        $this->display();
    }

    // 添加记录到数据库中
    public function store()
    {
        // 通过POST表单生成记录
//        $data = $this->db->create();
        // 先获取表单数据
        $data = [];
        foreach ($this->fields as $val) {
            if ($val == 'id' || $val == 'add_time') {
                // 自动增加字段和自动维护字段，不需要从表单中获取，由数据库自动维护
                continue;   // 跳过本次循环，继续下一次循环
            }
            $data[$val] = I('post.' . $val);
        }
//        $data['name'] = I('post.name');
//        dump($data);exit;
        // 插入数据
        if ($this->db->add($data)) {
            // 成功
            $this->success('记录插入成功', '/admin/' . CONTROLLER_NAME);
        } else {
            // 失败
            $this->error('记录插入失败！');
        }
    }

    // 显示修改记录的表单
    public function edit()
    {
        // 获取待修改的记录
        $id = I('get.id');
        $row = $this->db->find($id);
        // 显示视图
        $this->assign('row', $row);
        $this->display();
    }

    // 处理修改操作
    public function update()
    {
//        echo CONTROLLER_NAME;exit;
        // 先获取表单数据
        $data = [];
        foreach ($this->fields as $val) {
            if ($val == 'add_time') {
                continue;
            }
            $data[$val] = I('post.' . $val);
        }
        // 修改数据
        if ($this->db->save($data)) {
            // 成功
            $this->success('记录修改成功', '/admin/' . CONTROLLER_NAME);
        } else {
            // 失败
            $this->error('记录修改失败！');
        }
    }

    // 删除指定id记录
    public function delete()
    {
        // 获取id
        $id = I('get.id');
        // 删除之
        $result = $this->db->delete($id);
        // 善后处理
        if ($result) {
            $this->success('记录删除成功！', '/admin/' . CONTROLLER_NAME);
        } else {
            $this->error('记录删除失败！');
        }
    }
}