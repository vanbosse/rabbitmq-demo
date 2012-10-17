<?php

require_once __DIR__ . '/lib/php-amqplib/amqp.inc';

// Create a connection with RabbitMQ server.
$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

// Create a fanout exchange.
// A fanout exchange broadcasts to all known queues.
$channel->exchange_declare('notifications', 'fanout');

// Create and publish the message to the exchange.
$message = new AMQPMessage(
    json_encode(
        array(
            'type' => 'notification',
            'data' => 'Train arrives in 1m30s'
        )
    )
);
$channel->basic_publish($message, 'notifications');

// Close connection.
$channel->close();
$connection->close();
