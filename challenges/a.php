<?php

/*
Challenge 1: Read and write to Test::$secret before its output.

Rules::
1. No use of Reflection API / runkit extension
2. No stopping execution before Test::run()
3. No Exceptions or PHP errors / warnings notices allowed
4. No redefining $test

Hints:
1. Caesar
2. Magic methods
3. Requires something that became available in PHP 5.4

*/


class Test
{
    private $secret = 'Nyy lbhe Onfr ner orybat gb hf.';

    private $callback;

    final public function run()
    {
        call_user_func($this->callback);
        return $this->secret . PHP_EOL;
    }

    public function __set($k, $v)
    {
        $key          = $v[($v[$v])]; // $v is some kind of weird array
        $value        = $v(); // and a callback!
        $this->{$key} = $value;
    }

}


$test = new Test;

// start editing here

$reader = function & ($object, $property) {
    $value = & Closure::bind(function & () use ($property) {
        return $this->$property;
    }, $object, $object)->__invoke();

    return $value;
};

$secretKey = & $reader($test, 'secret');

function caesar($str, $n) {

    $ret = "";
    for($i = 0, $l = strlen($str); $i < $l; ++$i) {
        $c = ord($str[$i]);
        if (97 <= $c && $c < 123) {
            $ret.= chr(($c + $n + 7) % 26 + 97);
        } else if(65 <= $c && $c < 91) {
            $ret.= chr(($c + $n + 13) % 26 + 65);
        } else {
            $ret.= $str[$i];
        }
    }
    return $ret;
}

print 'secret key is : ' . caesar($secretKey, 13);

class TestHandler implements ArrayAccess {
    public function __construct() { return; }
    public function offsetSet($offset, $value) { return; }
    public function offsetExists($offset) { return; }
    public function offsetUnset($offset) { return; }

    public function offsetGet($offset) {
        return 'callback';
    }

    public function __invoke() {
        return function($variable = 'dummy text') {
            return $variable;
        };

    }
}

$test->unknownFunction = new TestHandler;
$secretKey = 'new secret key';

// end editing here

echo $test->run();

