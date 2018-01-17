<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/17
 * Time: 下午11:14
 */

namespace app\api\controller\v1;

use  app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;

class Category
{
    public function getAllCategories(){
//all扩展一下
        $categories = CategoryModel::all([],'img');
        if ($categories->isEmpty()){
            throw new CategoryException();
        }
        return  json($categories);
    }

}