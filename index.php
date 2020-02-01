<?php

/*
* This file is part of GeeksWeb Bot (GWB).
*
* GeeksWeb Bot (GWB) is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License version 3
* as published by the Free Software Foundation.
* 
* GeeksWeb Bot (GWB) is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.  <http://www.gnu.org/licenses/>
*
* Author(s):
*
* © 2015-2018 Kasra Madadipouya <kasra@madadipouya.com>
*
*/
require 'vendor/autoload.php';

$client = new Zelenin\Telegram\Bot\Api('995125653:AAEFbCMn1W8kbFT5kCzKLwItGA3BIKLyuSA'); // Set your access token
$url = 'https://testsd-bot.herokuapp.com/'; // URL RSS feed
$update = json_decode(file_get_contents('php://input'));
$json_dog = file_get_contents('https://dog.ceo/api/breeds/image/random');
$array_dog = json_decode($json_dog, TRUE);

$json_fox = file_get_contents('https://randomfox.ca/floof/');
$array_fox = json_decode($json_fox, TRUE);
    





//your app
try {
    if(file_exists('file.txt')==true){
        unlink('file.txt');
        $response=$client->sendChatAction([
            'chat_id'=>$update->message->chat->id,
            'action'=> 'typing'
        ]);
        if($update->message->text=='Янина' || $update->message->text=='Yanina'){
            $response=$client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text'=> "Я люблю тебя, {$update->message->text}!"
            ]);
            $response=$client->sendSticker([
                'chat_id' => $update->message->chat->id,
                'file_id'=> 2
            ]);
        }
        else
            $response=$client->sendMessage([
            'chat_id' => $update->message->chat->id,
            'text'=> "Привет {$update->message->text}!"
        ]);
    }
    else if($update->message->text == '/email')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
        	'chat_id' => $update->message->chat->id,
        	'text' => "можешь и сюда писать: sterbenxiiosu@gmail.com"
     	]);
    }
    else if($update->message->text == '/sayhello'){
        $response = $client->sendChatAction([
            'chat_id' => $update->message->chat->id, 'action' => 'typing']
        );
        $response=$client->sendMessage([
            'chat_id' => $update->message->chat->id,
            'text'=>'Как тебя зовут?'
        ]);
        file_put_contents('file.txt','1');
    }
    else if($update->message->text=='/loveclock'){
        $response = $client->sendChatAction([
                'chat_id' => $update->message->chat->id, 'action' => 'typing']
        );
        $now=new \DateTime();
        $date_start=new \DateTime('09/01/2019');
        $diff=date_diff($now,$date_start);
        $str="Вы встречаетесь с идиотом {$diff->y} лет, {$diff->m} месяцев , {$diff->d} дней, {$diff->h} часов, {$diff->m} минут и {$diff->s} секунд";
        $response=$client->sendMessage([
            'chat_id' => $update->message->chat->id,
            'text'=>$str
        ]);
    }
    else if($update->message->text == '/getdog')
    {
        $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
        $response = $client->sendPhoto(['chat_id' => $update->message->chat->id, 'photo' => $array_dog['message'] , 'action' => 'typing']);
    }
    else if($update->message->text == '/getfox')
    {
        $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
        $response = $client->sendPhoto(['chat_id' => $update->message->chat->id, 'photo' => $array_fox['image'] , 'action' => 'typing']);
    }
    else if($update->message->text == '/help')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "Список команд :\n/email -> получить email уедера\n/loveclock -> напиши чтобы узнать сколько ты встречаешься с идиотом\n/getdog - собакен\n/help ->получить списков команд"
    		]);
    }
    else if($update->message->text == '/latest')
    {
    		Feed::$cacheDir 	= __DIR__ . '/cache';
			Feed::$cacheExpire 	= '5 hours';
			$rss 		= Feed::loadRss($url);
			$items 		= $rss->item;
			$lastitem 	= $items[0];
			$lastlink 	= $lastitem->link;
			$lasttitle 	= $lastitem->title;
			$message = $lasttitle . " \n ". $lastlink;
			$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
			$response = $client->sendMessage([
					'chat_id' => $update->message->chat->id,
					'text' => $message
				]);
	}
	
    else
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "ой,какой же облом. попробуй: /help - ответы на все вопросы"
    		]);
    }
} catch (\Zelenin\Telegram\Bot\NotOkException $e) {
   
}