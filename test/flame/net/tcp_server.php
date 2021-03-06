<?php
flame\go(function() {
	$server = new flame\net\tcp_server();
	// 每个连接会回调到单独的协程函数中进行处理
	$server->handle(function($sock) {
		$i = 0;
		while($i<1000) {
			try{
				yield $sock->write('abcde');
				// echo "<= ", yield $sock->read(1), "\n";
				yield flame\time\sleep(1000);
			}catch(exception $ex) {
				// 客户端异常关闭连接会产生 EPIPE 错误需要处理
				var_dump($ex);
				break;
			}
		}
	});
	$server->bind("::", 7678);
	// 在 $server->close() 之前，会“阻塞”在此处
	yield $server->run();
});
flame\run();
