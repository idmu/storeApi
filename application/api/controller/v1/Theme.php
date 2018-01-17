<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/17
 * Time: 下午2:38
 */

namespace app\api\controller\v1;


use app\api\validate\IDCollection;
use app\api\model\Theme as ThemeModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\ThemeException;

class Theme
{

    public function getSimpleList($ids=''){
        (new IDCollection())->goCheck();
//        return 'success';
        $ids = explode(',',$ids);
        $result = ThemeModel::with('topicImg,headImg')
            ->select($ids);
        if ($result->isEmpty()){
            throw new ThemeException();
        }

        return json($result);
    }
/*
 *  theme/:id
 */
    public function getComplexOne($id){
        (new  IDMustBePositiveInt())->goCheck();
        $theme = ThemeModel::getThemeWithProducts($id);
        if (!$theme){
            throw new ThemeException();
        }
        return json($theme);
    }

}