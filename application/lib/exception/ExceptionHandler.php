<?php
/**
 * Created by PhpStorm.
 * User: chendian
 * Date: 2018/1/17
 * Time: 上午10:34
 */

namespace app\lib\exception;



use think\exception\Handle;
use think\Request;
use Exception;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;

    public function render(Exception $e){
        if ($e instanceof BaseException){
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }
        else {
            if (config('app_debug'))
            {
                return parent::render($e);
            }
                $this->code = 500;
                $this->msg = '服务器内部错误';
                $this->errorCode = 999;
        }
        $request = Request::instance();
        $result = [
            'msg' => $this->msg,
            'error_code'=> $this->errorCode,
            'request_url' => $request->url()
        ];

        return json($result,$this->code);

    }
}