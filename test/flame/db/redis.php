<?php
flame\go(function() {
	$obj = new flame\db\redis();
	var_dump($obj);
	echo "connect:", $obj->connect("127.0.0.1",16379), "\n";
	//echo "hmget hash 321 key1 123:\n";
	$res = yield $obj->hmget("hash", "321","key1", "123");
	var_dump($res);
	echo "hgetall hash:\n";
	$res = yield $obj->hgetall("hash");
	var_dump($res);
	echo "getlasterror:\n";
	$res = $obj->getlasterror();
	var_dump($res);
	echo "set arg_2 123:\n";
	$res = yield $obj->set("arg_2", 123);
	var_dump($res);
	echo "get arg2:\n";
	$res = yield $obj->get("arg_2");
	var_dump($res);
	echo "sadd set1 321:\n";
	$res = yield $obj->sadd("set1", 321);
	var_dump($res);
	echo "zrange page_rank 0 -1 withscores:\n";
	$res = yield $obj->zrange("page_rank",0,-1, "withscores");
	var_dump($res);
	echo "SUBSCRIBE foo bar:\n";
	$res = yield $obj->subscribe(["foo","bar"], function($inst, $channel, $message) {
		var_dump($inst);
		echo "channel:",$channel,",msg:",$message,"\n";
	});
	var_dump($res);
});
flame\run();
