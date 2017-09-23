<?php
/**
 * This file is part of the slackbotdemo project
 * By: omolara
 * Date: 9/23/17
 * Time: 4:23 PM
 */
require ("./vendor/autoload.php");
$loop = React\EventLoop\Factory::create();

$client = new \Slack\RealTimeClient($loop);
$client->setToken('xoxb-238782400277-QO249BgNYxGACliL1vYFGZqV'); //TODO 1. Put your token here

if (!$client->isConnected()) {
    $client->connect()->then(function () use ($client) {
        $client->getChannelById("C721931HD")->then(function (\Slack\Channel $channel) use ($client) {
            $messagebuilder = $client->getMessageBuilder()
                //->setText("@{$user->getUsername()}, what are you typing?")

                ->setText("Welcome here. You can ask me questions about forloopwomen events. Type next for the next event, all for all the events (past and upcoming ones) and upcoming for the upcoming events")
                //->setText("Hi all")
                ->setChannel($channel);

            $message = $messagebuilder->create();

            $client->postMessage($message);
        });
    });

}


$loop->run();