<?php
/* 
 * Redis操作类，封装redis扩展的操作
 * @author Hayden
 */
class TZ_Redis {
    // Redis扩展实例
    private $redis = NULL;
    private $nameSpace = '';//名称空间

    public function __construct($config = NULL) {
        if (!extension_loaded('redis')) {
            throw new Exception('the redis extension not found');
        } 
        if ($config === NULL) {
            $ci = &get_instance();
            $ci->config->load('redis');
            $config = $ci->config->item('redis');
            unset($ci);
        }
        $this->redis = new Redis();
        $this->redis->connect($config['host'], $config['port']);
        $this->redis->auth($config['password']);
        $this->redis->select($config['select']);
    }
    /**
     * 创建__clone方法防止对象被复制克隆
     */
	public function __clone() {
		trigger_error ( 'Clone is not allow!', E_USER_ERROR );
	}
    /**
	 * 销毁类
	 */
	public function __destruct() {
		$this->redis->close ();
		unset ( $this->redis );
	}

    /**
     * 设置名称空间
     * @param string $nameSpace
     */
    public function setNameSpace($nameSpace) {
        $this->nameSpace = $nameSpace.':';
        return $this;
    }

    /**
     * 取得cache值
     * @param string $key
     * @return mixed
     */
    public function get($key) {
        $key = $this->nameSpace . $key;
        $value = $this->redis->get($key);
        return $value !== false ? json_decode($value, true) : false;
    }
    
    /**
     * 设置cache值
     * @param string $key
     * @param type $value
     * @param type $ttl
     * @return \RRedis
     */
    public function set($key, $value, $ttl = 0) {
        $key = $this->nameSpace . $key;
        if ($ttl > 0) {
            $this->redis->setex($key, $ttl, json_encode($value));
        } else {
            $this->redis->set($key, json_encode($value));
        }
        return $this;
    }
    
    /**
     * 删除key
     * @return \RRedis
     */
    public function del($key) {
        $key = $this->nameSpace . $key;
        $this->redis->del($key);
        return $this;
    }

    /**
     * 取得hash表key值
     * @param type $key1
     * @param type $key2
     * @return type
     */
    public function hget($key1, $key2) {
        $key = $this->nameSpace . $key1;
        $value = $this->redis->hget($key, $key2);
        return $value !== false ? json_decode($value, true) : false;
    }
    
    /**
     * 设置hash表值
     * @param type $key1
     * @param type $key2
     * @param type $value
     * @return \RRedis
     */
    public function hset($key1, $key2, $value) {
        $key = $this->nameSpace . $key1;
        $this->redis->hset($key, $key2, json_encode($value));
        return $this;
    }
    
    /**
     * 删除key
     * @param type $key1
     * @param type $key2
     * @return \RRedis
     */
    public function hdel($key1, $key2) {
        $key = $this->nameSpace . $key1;
        $this->redis->hdel($key, $key2);
        return $this;
    }
}

/* End of file RRedis.php */
/* Location: ./application/libraries/RRedis.php */