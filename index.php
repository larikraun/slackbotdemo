<?php
/**
 * This file is part of the slackbotdemo project
 * By: omolara
 * Date: 9/23/17
 * Time: 4:23 PM
 */
require("./vendor/autoload.php");
$app = new \SlackBotDemo\AppLogic();
$loop = React\EventLoop\Factory::create();

$client = new \Slack\RealTimeClient($loop);
$client->setToken('YOUR_API_TOKEN'); //TODO 1. Put your token here


$client->on('message', function ($data) use ($client, $app) {

    $client->getChannelById($data["channel"])->then(function (\Slack\Channel $channel) use ($client, $data, $app) {
        $text = $data['text'];
        echo $text;
        if ($text == "next") {
            $event = $app->nextEvent();
            $date = new DateTime($event->getDate());
            $speakers = json_decode($event->getSpeakers(), true);

            $messagebuilder = $client->getMessageBuilder()
                //->setText("@{$user->getUsername()}, what are you typing?")

                ->setText("The next event is {$event->getName()} and it's happening on {$date->format("jS \of F Y h:i:s A")}. These are the list of speakers")
                //->setText("Hi all")
                ->setChannel($channel);
            if (is_array($speakers)) {
                foreach ($speakers as $speaker) {
                    $messagebuilder->addAttachment(new \Slack\Message\Attachment($speaker["name"], $speaker["title"], null, "#aba5ed"));
                }
            }
            $message = $messagebuilder->create();

            $client->postMessage($message);

            // $client->disconnect();
        } else if ($text = "all") {
            $events = $app->allEvents();
            foreach ($events as $event) {
                echo "all " . $event;
                $date = new DateTime($event->getDate());
                $speakers = json_decode($event->getSpeakers(), true);
                $messagebuilder = $client->getMessageBuilder()
                    //->setText("@{$user->getUsername()}, what are you typing?")

                    ->setText("All registered eventssssssss are below:\n {$event->getName()} is  on {$date->format("jS \of F Y h:i:s A")} :dancer::skin-tone-5:. Speakers are")
                    //->setText("Hi all")
                    ->setChannel($channel);
                if (is_array($speakers)) {
                    foreach ($speakers as $speaker) {
                        $messagebuilder->addAttachment(new \Slack\Message\Attachment($speaker["name"], $speaker["title"], null, "#aba5ed"));
                    }
                }
                $message = $messagebuilder->create();

                $client->postMessage($message);
            }


        } else if ($text = "upcoming") {
            $events = $app->upComingEvents();
            foreach ($events as $event) {
                echo "upcoming " . $event;
                $date = new DateTime($event->getDate());
                $speakers = json_decode($event->getSpeakers(), true);
                $messagebuilder = $client->getMessageBuilder()
                    //->setText("@{$user->getUsername()}, what are you typing?")

                    ->setText("The upcoming events are below: \n {$event->getName()} and it's happening on {$date->format("jS \of F Y h:i:s A")} :dancer::skin-tone-5:. These are the list of speakers")
                    //->setText("Hi all")
                    ->setChannel($channel);
                if (is_array($speakers)) {
                    foreach ($speakers as $speaker) {
                        $messagebuilder->addAttachment(new \Slack\Message\Attachment($speaker["name"], $speaker["title"], null, "#aba5ed"));
                    }
                }
                $message = $messagebuilder->create();

                $client->postMessage($message);
            }


        }
        $client->disconnect();
    });

    //  $client->disconnect();
});

if (!$client->isConnected()) {
    $client->connect()->then(function () use ($client) {
        $client->getChannelById("C721931HD")->then(function (\Slack\Channel $channel) use ($client) {
            $messagebuilder = $client->getMessageBuilder()
                ->setText("Welcome here. You can ask me questions about forloopwomen events. Type next for the next event, all for all the events (past and upcoming ones) and upcoming for the upcoming events")
                ->setChannel($channel);

            $message = $messagebuilder->create();

            $client->postMessage($message);
        });
    });

}


$loop->run();