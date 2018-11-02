<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    // 
    protected $table = 'privileges';

    public function tree()
    {
        $data = self::get();
        $res = $this->_tree($data);
        return $res;
    }

    public function _tree($data,$parent_id=0)
    {
        $res = [];
        foreach($data as $v)
        {
            if($v->parent_id==$parent_id)
            {
                $v->child = $this->_tree($data,$v->id);
                $res[] = $v;
            }
        }
        return $res;
    }
}
