<?php

include("../config.php");
initBT();

if(isset($_GET["bt_challenge"])) {
    echo(Braintree_WebhookNotification::verify($_GET["bt_challenge"]));
}


if(
    isset($_POST["bt_signature"]) &&
    isset($_POST["bt_payload"])
) {
    $webhookNotification = Braintree_WebhookNotification::parse(
        $_POST["bt_signature"], $_POST["bt_payload"]
    );

    $message =
        "[Webhook Received " . $webhookNotification->timestamp->format('Y-m-d H:i:s') . "] "
        . "Kind: " . $webhookNotification->kind . " | "
        . "Subscription: " . $webhookNotification->subscription->id . "\n"
        . "Subscription Object is: " . json_encode($webhookNotification->subscription);

    mail ('r.may@me.com' ,  $webhookNotification->kind, $message );
}


?>