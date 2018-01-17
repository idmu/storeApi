<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/17
 * Time: 下午2:40
 */

namespace app\api\model;


class Theme extends BaseModel
{
    //关联img
    protected $hidden = ['delete_time','update_time','topic_img_id','head_img_id'];
    public function topicImg(){
        return $this->belongsTo('Image','topic_img_id','id');
    }
    //关联
    public function headImg(){
        return $this->belongsTo('Image','head_img_id','id');
    }
    //多对多
    public function products(){
        return $this->belongsToMany('Product',
            'theme_product','product_id','theme_id');

    }

    public static function getThemeWithProducts($id){
        $theme = self::with(['products','topicImg','headImg'])
            ->find($id);
        return $theme;
    }


}