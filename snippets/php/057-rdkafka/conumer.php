<?php

require_once "config.php";

use RdKafka\Conf;
use RdKafka\KafkaConsumer;
use RdKafka\TopicPartition;

$conf = new RdKafka\Conf();

function rebalance(RdKafka\KafkaConsumer $kafka, $err, array $partitions = null) {
	echo "Rebalance call\n";

	switch ($err) {
			case RD_KAFKA_RESP_ERR__ASSIGN_PARTITIONS:

				break;
			case RD_KAFKA_RESP_ERR__REVOKE_PARTITIONS:
				$kafka->assign(NULL);
				break;
			default:
				throw new Exception($err);
		}
}

$conf->set('group.id', Config::$groupId);
$conf->set('metadata.broker.list', Config::$metadataBbrokerList);
$conf->set('enable.auto.commit', 'false');
$conf->set('enable.partition.eof', 'true');
$conf->set('statistics.interval.ms', '15000');
$conf->set('queued.max.messages.kbytes', '1000');
$conf->set('auto.offset.reset', 'latest');
$conf->set('socket.timeout.ms', '120000');
$conf->set('session.timeout.ms', '120000');
$conf->set('auto.offset.reset', 'error');
$conf->setRebalanceCb('rebalance');

$partitions = [];
for ($i = 0; $i < 8; $i++) {
	$partitions[$i] = new RdKafka\TopicPartition(Config::$topic, $i);
	$partitions[$i]->setOffset(RD_KAFKA_OFFSET_BEGINNING);
}

$rk = new RdKafka\KafkaConsumer($conf);
$rk->subscribe([Config::$topic]);
$rk->assign($partitions);
$rk->canRebalance = false;

while (true) {
    $message = $rk->consume(100000);
    switch ($message->err) {
        case RD_KAFKA_RESP_ERR_NO_ERROR:
            var_dump($message);
            break;
        case RD_KAFKA_RESP_ERR__PARTITION_EOF:
            echo "No more messages; will wait for more\n";
            break;
        case RD_KAFKA_RESP_ERR__TIMED_OUT:
            echo "Timed out\n";
            break;
        default:
            echo "ERROR: ".$message->err." ".$message->errstr()."\n";
            break;
    }
    sleep(1);
}
