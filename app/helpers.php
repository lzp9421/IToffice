<?php
/**
 * Created by PhpStorm.
 * User: MyStudio
 * Date: 2016/12/6
 * Time: 8:50
 */

use Illuminate\Contracts\Routing\UrlGenerator;

if (!function_exists('asset_cdn')) {
    /**
     * 将相对路径映射到cdn服务获取静态资源
     * @param $path
     * @return string
     */
    function asset_cdn($path)
    {
        return Config::get('common.cdn_enable') ? Config::get('common.cdn_domain') . $path : asset($path);
    }
}

if (!function_exists('is_mobile_request')) {
    /** 判断是否是手机
     * @return bool
     */
    function is_mobile_request()
    {
        $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
        $mobile_browser = '0';
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
            $mobile_browser++;
        if ((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') !== false))
            $mobile_browser++;
        if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
            $mobile_browser++;
        if (isset($_SERVER['HTTP_PROFILE']))
            $mobile_browser++;
        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
            'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
            'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
            'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
            'newt', 'noki', 'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
            'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
            'wapr', 'webc', 'winw', 'winw', 'xda', 'xda-'
        );
        if (in_array($mobile_ua, $mobile_agents))
            $mobile_browser++;
        if (strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
            $mobile_browser++;
        // Pre-final check to reset everything if the user is on Windows
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
            $mobile_browser = 0;
        //将百度爬虫识别为pc浏览器
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'baiduspider') !== false)
            $mobile_browser = 0;
        // But WP7 is also Windows, with a slightly different characteristic
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
            $mobile_browser++;
        if ($mobile_browser > 0)
            return true;
        else
            return false;
    }
}

if(!function_exists('mail_address')) {
    function mail_address($email) {
        $arr = explode('@', $email);
        $suffix = count($arr) == 2 ? $arr[1] : "";

        switch($suffix) {
            case '163.com' : return 'http://mail.163.com';
            case 'qq.com' : return 'https://mail.qq.com';
            case '126.com' : return 'http://www.126.com/';
            case 'sina.com' : case 'sina.cn' : return 'http://mail.sina.com.cn/';
            case 'aliyun.com': return 'https://mail.aliyun.com/';
            case 'sohu.com' : return 'http://mail.sohu.com/';
            case 'outlook.com': case 'hotmail.com' : return 'https://login.live.com/';
            case '139.com' : return 'http://mail.10086.cn/';
            case '189.cn' : return 'http://webmail30.189.cn/w2/';
            default : return false;
        }
    }
}

if(!function_exists('error')) {
    function error($info = ['error'], $redirect = null) {
        if(\Request::ajax()) {
            return \Response::json(['status' => 'error', 'info' => (array)$info]);
        } elseif(is_callable($redirect)) {
            return call_user_func($redirect);
        } elseif(empty($redirect)) {
            return back()->withErrors((array)$info)->withInput();
        } else {
            return redirect(url($redirect))->withErrors((array)$info)->withInput();
        }
    }
}


if(!function_exists('success')) {
    function success($info = 'success', $redirect = null) {
        if(\Request::ajax()) {
            return \Response::json(['status' => 'success', 'info' => (string)$info]);
        } elseif(is_callable($redirect)) {
            return call_user_func($redirect);
        } elseif(empty($redirect)) {
            return back()->with(['info' => (string)$info]);
        } else {
            return redirect(url($redirect))->with(['info' => (string)$info]);
        }
    }
}

if(!function_exists('url_append')) {
    function url_append($request, $params = []) {
        return $request->url() . '?' . http_build_query(array_merge($request->all(), (array)$params));
    }
}