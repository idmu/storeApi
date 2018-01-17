<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/17
 * Time: 上午9:27
 */

namespace app\api\model;


use think\Model;

class BaseModel extends Model
{
    protected $hidden = ['delete_time','update_time'];
    protected function  prefixImgUrl($value, $data){
        $finalUrl = $value;
        if($data['from'] == 1){
            // $finalUrl = config('setting.img_prefix').$value;
            $finalUrl = 'http://localhost:8888/images'.$value;
        }
        return $finalUrl;
    }
}