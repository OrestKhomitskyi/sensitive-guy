<?php

require(__DIR__ . '/vendor/paralleldots/apis/autoload.php');

$api_key = "UMdMIPiyi0xlKbivrG5Eahx68gscgK4DoAkclkrAmlw";

set_api_key($api_key);
echo facial_emotion("./sasha.jpg");
