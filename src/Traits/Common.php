<?php
/**
 * 公用方法
 * @authors Radish (1004622952@qq.com)
 * @date    2020-04-07 15:24 Tuesday
 */

namespace Radish\Helper\Traits;

trait Common
{
    /**
     * XML转换成数组
     * @param  xml $xml 
     * @return array
     */
    public function xmlToArray($xml)
    {
        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }

    /**
     * 输出xml字符
    **/
    public function arrayToXml(array $array, $time = true)
    {
        $xml = "<xml>";
        if (!isset($array['CreateTime']) && $time) {
            $array['CreateTime'] = time();
        }
        foreach ($array as $key => $val)
        {
            if (is_numeric($val)) {
                $xml .= "<".$key.">".$val."</".$key.">";
            } else if ($key == 'KfAccount') {
                $xml .= "<TransInfo><".$key."><![CDATA[".$val."]]></".$key."></TransInfo>";
            } else {
                $xml .= "<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml .= "</xml>";

        return $xml;
    }

    /**
      * 获得随机字符串
      * @param $len          需要的长度
      * @param $special      是否需要特殊符号
      * @return string       返回随机字符串
      */
    public function getRandomStr($len = 20, $special = false)
    {
        $chars = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k","l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v","w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G","H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
        if($special){
            $chars = array_merge($chars, ["!", "@", "#", "$", "?", "|", "{", "/", ":", ";", "%", "^", "&", "*", "(", ")", "-", "_", "[", "]", "}", "<", ">", "~", "+", "=", ",", "."]);
        }
        $charsLen = count($chars) - 1;
        shuffle($chars);  //打乱数组顺序
        $str = '';
        for($i=0; $i<$len; $i++){
            $str .= $chars[mt_rand(0, $charsLen)]; //随机取出一位
        }

        return $str;
    }

    /**
     * 拼接数组
     * @param  array  $params    待拼接
     * @param  string $connector 拼接符
     * @return string            拼接后字符串
     */
    public function jointString(array $params, $connector = '&')
    {
        ksort($params);
        $d = $string = '';
        foreach ($params as $key => $val) {
            $val && $string .= $d . $key . '=' . $val;
            $d = $connector;
        }

        return $string;
    }
}