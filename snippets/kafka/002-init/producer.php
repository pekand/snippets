<?php

require_once "config.php";

use RdKafka\Conf;
use RdKafka\KafkaConsumer;
use RdKafka\TopicPartition;

$conf = new RdKafka\Conf();
$conf->set('bootstrap.servers', Config::$metadataBbrokerList);
$conf->set('socket.timeout.ms', (string) 50);
$conf->set('queue.buffering.max.messages', (string) 1000);
$conf->set('max.in.flight.requests.per.connection', (string) 1);
$conf->setDrMsgCb(
    function (\RdKafka\Producer $producer, \RdKafka\Message $message): void {
        if ($message->err !== RD_KAFKA_RESP_ERR_NO_ERROR) {
            // Perform your error handling here using $message->errstr()
        }
    }
);
$conf->set('log_level', (string) LOG_DEBUG);
$conf->set('debug', 'all');
$conf->set('statistics.interval.ms', (string) 1000);



$topicConf = new \RdKafka\TopicConf();
$topicConf->set('message.timeout.ms', (string) 30000);
$topicConf->set('request.required.acks', (string) -1);
$topicConf->set('request.timeout.ms', (string) 5000);

$producer = new \RdKafka\Producer($conf);

$topic = $producer->newTopic('test123', $topicConf);

$count = 10;
while($count--) {
    $key = $count % 10;
    $payload = "payload-$count-$key".date("Y-m-d h:i:s");
    $topic->produce(RD_KAFKA_PARTITION_UA, 0, $payload, (string) $key);

    // trigger callback queues
    $producer->poll(1);
    sleep(1);
}

$producer->flush(5000);
