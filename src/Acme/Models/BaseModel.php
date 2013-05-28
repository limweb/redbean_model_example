<?php
namespace Acme\Models;
use \RedBean_Facade as R;

abstract class BaseModel {
    protected $model;

    public function __set($name, $value)
    {
        $this->model->$name = $value;
    }

    public function __get($name)
    {
        return $this->model->$name;
    }

    public function __construct($id=NULL)
    {
        if ($id === NULL) {
            $this->model = R::dispense($this->table);
        } else {
            $this->model = BaseModel::load($this->table, $id);
        }
    }

    static protected function load($table, $id) {
        echo "loading $id from $table \n";
        return R::load($table, $id);
    }

    public function doSave(\RedBean_OODBBean &$model)
    {
        $date = date('Y-m-d H:i:s');
        if (!$model->created) {
            $model->created = $date;
        }
        $model->modified = $date;

        $id = R::store($model);
        $model->id = $id;
        return $id;
    }

    public function save()
    {
        return $this->doSave($this->model);
    }

    public function delete($model) {
        R::trash($model);
    }
}