<?php

if (!function_exists('bar')) {
    function bar($message)
    {
        return \Debugbar::info($message);
    }
}

function telegram_bot_message($message){

    $api_url = 'https://api.telegram.org/bot';
    $bot_token = '5193208083:AAFA7HE-qZwbB3I24aL034RnrFmcbsntcEU';
	$chat_id = '-1001741099979';

    $query = [
        'chat_id' => $chat_id,
        'parse_mode' => 'HTML',
        'text' => print_r($message, true),
        // 'reply_markup' => json_encode(['inline_keyboard' => $keyboard])
    ];

    $url = $api_url . $bot_token . '/sendMessage?' . http_build_query($query);



    return file_get_contents($url);
}


// $send_message_url = 'https://api.telegram.org/bot'.$telegram_bot_token.'/sendMessage'? . $data;

// file_get_contents($send_message_url);

// Создание телеграм бота:

// botfather
//   /start
//   /newbot
// создать группу или канал
// добавить бота
// сделать его адимном
// написть в личку боту
// написать в чат
// https://api.telegram.org/bot<bot_token>/getUpdates
// посмотреть chat id -> -1001741099979
