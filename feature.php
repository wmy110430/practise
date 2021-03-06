<?php
//1、多维数组排序
$items = array(
    array('http://www.abc.com/a/', 100, 120),
    array('http://www.abc.com/b/index.php', 50, 80),
    array('http://www.abc.com/a/index.html', 90, 100),
    array('http://www.abc.com/a/?id=12345', 200, 33),
    array('http://www.abc.com/c/index.html', 10, 20),
    array('http://www.abc.com/abc/', 10, 30)
);
//变成如下的样子：
array (
    array ( 'http://www.abc.com/a/', 390,253),
    array ('http://www.abc.com/b/', 50,80),
    array ('http://www.abc.com/c/', 10,20),
    array ('http://www.abc.com/abc/', 10,30)
);

$map=[];
foreach($items as $key=>$item){
    $pos = strrpos($item[0],'/');
    $key = substr($item[0],0,$pos+1);
    $item[0] = $key;
    if(isset($map[$key])){
        $map[$key][1]+=$item[1] ;
        $map[$key][2]+=$item[2];
    }else{
        $map[$key] = $item;
    }
}
$result = array_values($map);
var_dump($result);
/**
 * 猴子选大王，n只猴子，数到第m只踢出群，重新从1数，最后剩下的猴子是大王
 */
function King($n,$m)
{
    if($n<2)
    {
        return $n;
    }
    $monkeys_arr = range(1,$n);
    $i = 0;
    while(count($monkeys_arr)>1)
    {
        $head = array_shift($monkeys_arr);
        if (($i+1)%$m != 0) {
            array_push($monkey_arr, $head);
        }
        $i++;
    }

    return $monkeys_arr[0];
}
//3、得分计算，已知道选题提交的答案是
$commits= 'A,B,B,A,C,C,D,A,B,C,D,C,C,C,D,A,B,C,D,A';
//实际的答案是：
$answers= 'A,A,B,A,D,C,D,A,A,C,C,D,C,D,A,B,C,D,C,D';
//每题得分是5分，那么这个同学得分是多少？
$commits_arr = explode(',',$commits);
$answers_arr = explode(',',$answers);
$right_arr = array_intersect_assoc($commits_arr,$answers_arr);
$score = 5*count($right_arr);
echo $score,PHP_EOL;


//5、实现一个对象的数组式访问接口
class ObjArray implements ArrayAccess
{
    private $container = [];

    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->container[$offset] ?: NULL;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container['offset'] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }
}

//6、有1000瓶水，其中有一瓶有毒，小白鼠只要尝一点带毒的水24小时后就会死亡，问至少要多少只小白鼠才能在24小时鉴别出哪瓶水有毒？
function getNum($n){
    $num = ceil(log($n,2));
    return $num;
}

//7、使用serialize序列化一个对象，并使用__sleep和__wakeup方法。
class Test
{
    public $name ='xiaowangzi';
    public function __sleep()
    {
        echo 'this is a serialize etest',PHP_EOL;
        return ['name'];
    }
    public function __wakeup()
    {
        echo 'this is an unserizalize_test',PHP_EOL;
    }

}
$test = new Test();
$a = serialize($test);
//var_dump($a);
$test2 = unserialize($a);

//8.利用数组栈实现翻转字符串功能
$string = 'abcd';

function getStrRev($string)
{
    $back = str_split($string,1);
    while(count($back)>0){
        $arr[] = array_pop($back);
    }
    return implode('',$arr);
}
/*
9.从m个数中选出n个数来(0<n<=m)，要求n个数之间不能有重复，其和等于一个定值k。求一段程序，罗列所有的可能。	
*/
define('K', 18);

$nums = array(11, 18, 12, 1, -2, 20, 8, 10, 7, 6);

$numscount = count($nums);
//每一次左移动都表示“乘以 2”。
$subscount = 2 << ($numscount - 1); 


for ($i = 1; $i < $subscount; $i++) {
    $subitem = array();
    $binstr = decbin($i);
    /填充左边0，实现0补全
    $binstr = str_pad($binstr, $numscount, '0', STR_PAD_LEFT);/
    for ($j = 0; $j < $numscount; $j++) {
        if (1 == $binstr[$j]) {
            $subitem[] = $nums[$j];
        }
    }
    if (K == array_sum($subitem)) {
        echo json_encode($subitem) . "\n";
    }
}


