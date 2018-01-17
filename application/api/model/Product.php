<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/17
 * Time: 下午2:39
 */

namespace app\api\model;

class Product extends BaseModel
{
    protected $hidden =[ 'category_id','create_time','delete_time',
        'update_time','pivot','from'
    ];
    public function getMainImgUrlAttr($value,$data){
        return $this->prefixImgUrl($value,$data);
    }

    public static function getMostRecent($count){
        //limit表示查询指定的数量
        $product = self::limit($count)
//  creat_time指定排序的依据段  desc 指的是排序规则
            ->order('create_time desc')
            ->select();
        return $product;
    }

    public  static function getProductsByCategoryID($categoryID){
       $products = self::where('category_id','=',$categoryID)
           ->select();
       return $products;
    }

}