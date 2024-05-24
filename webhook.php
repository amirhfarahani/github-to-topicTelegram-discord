<?php

// تنظیمات توکن تلگرام و آدرس وبهوک دیسکورد
$telegramBotToken = 'telegramBotToken';
$telegramChatId = 'telegramChatId'; // شناسه گروه
$telegramTopicId = 'telegramTopicId'; // شناسه موضوع
$discordWebhookUrl = 'discordWebhookUrl';

function sendTelegramMessage($message, $botToken, $chatId, $topicId) {
    $url = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&message_thread_id=$topicId&text=" . urlencode($message);
    file_get_contents($url);
}

function sendDiscordMessage($message, $webhookUrl) {
    $data = [
        'content' => $message
    ];
    $options = [
        'http' => [
            'header' => "Content-type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($data),
        ],
    ];
    $context = stream_context_create($options);
    file_get_contents($webhookUrl, false, $context);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payload = file_get_contents('php://input');
    $data = json_decode($payload, true);

    // پردازش داده‌ها و استخراج اطلاعات مورد نظر
    $repository = $data['repository']['full_name'];
    $pusher = $data['pusher']['name'];
    $message = "Repository: $repository\nPusher: $pusher\nEvent: Push";

    // ارسال پیام به تلگرام و دیسکورد
    sendTelegramMessage($message, $telegramBotToken, $telegramChatId, $telegramTopicId);
    sendDiscordMessage($message, $discordWebhookUrl);

    // پاسخ به گیت‌هاب
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success']);
} else {
    // روش درخواست اشتباه است
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['status' => 'failure']);
}
?>
