<?php

require_once __DIR__ . '/lib/php-amqplib/amqp.inc';

// Create a connection with RabbitMQ server.
$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

// Create a fanout exchange.
// A fanout exchange broadcasts to all known queues.
$channel->exchange_declare('updates', 'fanout');

// Create and publish the message to the exchange.
$data = array(
    'type' => 'update',
    'data' => array(
        'minutes' => rand(0, 60),
        'seconds' => rand(0, 60)
    )
);
$message = new AMQPMessage(json_encode($data));
$channel->basic_publish($message, 'updates');

// Close connection.
$channel->close();
$connection->close();
