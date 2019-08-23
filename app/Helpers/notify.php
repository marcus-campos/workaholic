<?php
/**
 * User: marcus-campos
 * Date: 18/03/18
 * Time: 20:05
 */

 function discordNotify($channel, $msg) {
    $client = new \DiscordWebhooks\Client(env('DISCORD_WEBHOOK_URL', ''));
    $embed = new \DiscordWebhooks\Embed();

    $embed->description($msg);

    $client->username('Bot')->message($msg)->embed($embed)->send();
 }