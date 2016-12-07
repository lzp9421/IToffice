<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Log;

class WechatController extends Controller
{
    public function serve()
    {
//        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            switch ($message->MsgType) {
                case 'event':
                    # 事件消息...
                    return '事件消息:'.$message->Event;
                    break;
                case 'text':
                    # 文字消息...
                    return '文字消息:'.$message;
                    break;
                case 'image':
                    # 图片消息...
                    return '图片消息:'.$message;
                    break;
                case 'voice':
                    # 语音消息...
                    return '语音消息:'.$message;
                    break;
                case 'video':
                    # 视频消息...
                    return '视频消息:'.$message;
                    break;
                case 'location':
                    # 坐标消息...
                    return '坐标消息:'.$message;
                    break;
                case 'link':
                    # 链接消息...
                    return '链接消息:'.$message;
                    break;
                // ... 其它消息
                default:
                    # code...
                    return '其它消息:'.$message;
                    break;
            }
            //return "欢迎关注 overtrue！";
        });

//        Log::info('return response.');

        return $wechat->server->serve();
    }
}
