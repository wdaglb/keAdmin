<?php
// +----------------------------------------------------------------------
// | Name: shop.cn
// | Author King east To 1207877378@qq.com
// +----------------------------------------------------------------------

namespace ke;


class Http
{
    private $url='';

    private $post=false;

    private $option=[
        'CURLOPT_HEADER'=>false,          // 是否输出头数据
        'CURLOPT_RETURNTRANSFER'=>true,  // 是否把返回数据存储至变量
    ];

    private $data=[];

    private $result=null;

    private $error=null;

    public function __construct($url,$method='GET')
    {
        $this->url=$url;
        $this->post=strtoupper($method)!='GET';
    }

    public function setUrl($url,$method='GET')
    {
        $this->url=$url;
        $this->post=strtoupper($method)!='GET';
    }

    /**
     * 设置返回变量
     * @param $a
     */
    public function setReturnVar($a)
    {
        $this->option['CURLOPT_RETURNTRANSFER']=$a;
    }

    /**
     * 设置输出头数据
     * @param $a
     */
    public function setOptHeader($a)
    {
        $this->option['CURLOPT_HEADER']=$a;
    }

    /**
     * 设置POST发送数据
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data=$data;
        return $this;
    }

    /**
     * 执行http请求
     * @return $this|bool
     */
    public function send()
    {
        $curl=curl_init();

        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_HEADER, $this->option['CURLOPT_HEADER']);  // 是否输出header
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, $this->option['CURLOPT_RETURNTRANSFER']);
        if($this->post){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $this->data);
        }
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $this->result = curl_exec($curl);
        if(!$this->result){
            $this->error = curl_errno($curl);
            return false;
        }
        curl_close($curl);
        return $this;
    }

    /**
     * 返回错误信息
     * @return string
     */
    public function error()
    {
        return $this->error;
    }

    /**
     * 返回数组形式
     * @return array
     */
    public function toArray()
    {
        if(!is_null($this->error)) return null;
        return json_decode($this->result,true);
    }

    /**
     * 返回json形式
     * @return json
     */
    public function toJson()
    {
        if(!is_null($this->error)) return null;
        return json_decode($this->result);
    }

    /**
     * 返回字符串形式
     * @return string
     */
    public function toString()
    {
        if(!is_null($this->error)) return null;
        return $this->result;
    }

}