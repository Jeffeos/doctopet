<?php


namespace App\service;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\NativeHttpClient;

class NotificationManager extends AbstractController
{
    function sendMessage()
    {

        $content = array(
            "en" => "Don't forget to take care of your friend! :-)",
        );


        $headings = array(
            "en" => "DOCTOPET - Your Panda needs you"
        );

        $fields = array(
            'app_id' => $this->getParameter("notifications_onesignal"),
            'include_player_ids' => array("6c48dcf9-f564-4167-b0d7-532972178db9","95b2a02f-6381-4907-97af-85c6cca325f9","8e0f21fa-9a5a-4ae7-a9a6-ca1f24294b86"),
            'data' => array("foo" => "bar"),
            'contents' => $content,
            'chrome_big_picture	' => "http://localhost:8000//images/notif_panda.gif",
            'headings' => $headings,
            'web_url' => "http://localhost:8000/pet/1/addPill",
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

}