<?php
/**
 * Created by PhpStorm.
 * User: borisov
 * Date: 13.12.17
 * Time: 16:43
 */

$command = 'php /webPush/Sender.php '.$_GET['token'];
exec($command);