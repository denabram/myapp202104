<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body style="color: #0a0; background-color: #333;">
<?php
/*settings*/
//$_SERVER['dport']
$token = $_SERVER['token'];
$achat = ['1126015709'];
define('DB_HOST', $_SERVER['dserver']);
define('DB_USER', $_SERVER['dusername']);
define('DB_PASSWORD', $_SERVER['dpass']);
define('DB_NAME', $_SERVER['dname']);
$pdo = false;
date_default_timezone_set('UTC');
$images = ['AgACAgEAAxkBAANHYIKLhQEar_OJhq2yzCeXPRFl-MwAAhSwMRsx1hBEUy-BYPjsY1IXbcVKFwADAQADAgADeQAD1D4CAAEfBA',
	'AgACAgEAAxkBAANJYIKLhrl1nuqYW2Z3pTy0COLC1NIAAhawMRsx1hBEtAEejKU7MD91YsJKFwADAQADAgADeQADf3YCAAEfBA',
	'AgACAgEAAxkBAANKYIKLh7wk8Wx6VJiDquMBLvGcDjsAAhewMRsx1hBEsE6HySSmIWx1jPNLFwADAQADAgADeQAD80cBAAEfBA',
	'AgACAgEAAxkBAANLYIKLiIITWuUDhI7BFDKT9wcpN2YAAhiwMRsx1hBEP4hcdJzDo0KCG9BKFwADAQADAgADeQADV1UCAAEfBA',
	'AgACAgEAAxkBAANMYIKLiJjrombjyM8DBKZK2kUQyNQAAhmwMRsx1hBET_x3P71MeygoHNBKFwADAQADAgADeQADN1QCAAEfBA',
	'AgACAgEAAxkBAANNYIKLiffaOW0NRseqxrV0gAABg44uAAIasDEbMdYQRPID5e4T6GxE7Z0SMAAEAQADAgADeQAD85sGAAEfBA',
	'AgACAgEAAxkBAANOYIKLisDmpzycvh8jfJhcOlQEfhQAAhuwMRsx1hBEHQ4ruuUGgkdRGtBKFwADAQADAgADeQADEVICAAEfBA',
	'AgACAgEAAxkBAANPYIKLinUZ00h3zZen2osKHDsbjcgAAhywMRsx1hBEGFPf-YDSgFbu_LRLFwADAQADAgADeQADQEMBAAEfBA',
	'AgACAgEAAxkBAANQYIKLjJZXE3On9po79KbAAAGn9Mh6AAIdsDEbMdYQRD_EVW3Z-s_NDDQjTRcAAwEAAwIAA3kAA8EtAAIfBA',
	'AgACAgEAAxkBAANRYIKLjWNqmAUgoXd9QBA5-wa7TRUAAh6wMRsx1hBE0FG563yeSbjOe8hKFwADAQADAgADeQADyjcCAAEfBA',
	'AgACAgEAAxkBAANSYIKLjhC8horWOFfR_re8JZ3jTuoAAh-wMRsx1hBEf-DT92R5Dp_qe8hKFwADAQADAgADeQADUTgCAAEfBA',
	'AgACAgEAAxkBAANTYIKLj0FezJp6HNr-N4vqrcrmEF4AAiCwMRsx1hBEF1-m0bL5PJLEls5KFwADAQADAgADeQADXTYCAAEfBA',
	'AgACAgEAAxkBAANUYIKLkDEfgD--lXBq22S9dUb-StAAAiGwMRsx1hBEYoDxmMXFlUZjb8VKFwADAQADAgADeQADvEICAAEfBA',
	'AgACAgEAAxkBAANVYIKLkZBdOh-ASzNnaxH06KIahwYAAiKwMRsx1hBEhUDl_TQ_sb0b6MNKFwADAQADAgADeQADjT4CAAEfBA',
	'AgACAgEAAxkBAANWYIKLkUlI3N1TgrSIx2jNGZPrb1MAAiOwMRsx1hBEc_0-wYRLTnz-ODhMFwADAQADAgADeAADcHQAAh8E',
	'AgACAgEAAxkBAANXYIKLkjwO133C_SRptdHz_QrgkT0AAiSwMRsx1hBEYZirdMxxrtbSmRIwAAQBAAMCAAN5AAMejwYAAR8E',
	'AgACAgEAAxkBAANYYIKLki5494nJW61B6Ur-sX5Eq08AAiWwMRsx1hBE3ZI2VAJ0roDxsjZMFwADAQADAgADeQADLoAAAh8E',
	'AgACAgEAAxkBAANZYIKLk2P1zIG93pyJrMeH4-JflyMAAiawMRsx1hBEyB0uYZAkY-zzKDVMFwADAQADAgADeQADjnwAAh8E'];
$videos = [[ 'link' => '', 'image' => 'BAACAgEAAxkBAAMGYH8lD162Opqejy6tEn400eViW7YAAlkBAAIPNflH8LJUft5pGCUfBA', 'name' => 'playing with my tits', 'premium' => false ],
	[ 'link' => '', 'image' => 'BAACAgEAAxkBAAMHYH8mFlbhzLe9uUivDLA5bDHYR8cAAloBAAIPNflHhTv82ZKkHXAfBA', 'name' => 'sexy legs of schoolgirl', 'premium' => false ],
	[ 'link' => '', 'image' => 'BAACAgEAAxkBAAMIYH8miDycyeeP0JWW9TAMXPZtnXgAAlsBAAIPNflH4zWO5E6agEcfBA', 'name' => 'my body and pussy', 'premium' => false ],
	[ 'link' => 'https://cloud.mail.ru/public/hf5G/gvwTVyKge', 'image' => 'BAACAgEAAxkBAANBYIEug0Wa72G0tqXiZBwtXJIzM24AAgQDAAIx1ghEWwhGP0uef6YfBA', 'name' => 'fingering pussy', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/MAJf/ctjouGFWG', 'image' => 'BAACAgEAAxkBAANCYIEupIcP_JEhzsOiSAE4OWWitrAAAgUDAAIx1ghEIlic6ZZiF7kfBA', 'name' => 'fuck holes with a sex ,toy', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/xz6x/zny7NhEUm', 'image' => 'BAACAgEAAxkBAANDYIEuxiTW9FC_j6yTQaz59QfYT8IAAgYDAAIx1ghEApwUvwdlOY8fBA', 'name' => 'fucks my pussy with ,dildo', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/dL6K/TFQU7bwTG', 'image' => 'BAACAgEAAxkBAANGYIEvAwx5FUlZd7P6O0TIphduyt0AAgkDAAIx1ghEHB20PdyNqMgfBA', 'name' => 'girl in shower', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/MzZA/ZfNcBF38F', 'image' => 'BAACAgEAAxkBAAMsYIEsJm1ETDeqpohlg4ScbzOXRhQAAu8CAAIx1ghEmyHPVA6ip0wfBA', 'name' => 'I love my sexy legs', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/b8oH/wBxRU5y9B', 'image' => 'BAACAgEAAxkBAANEYIEu2ouRaeheh5UoYnsxviyt8BoAAgcDAAIx1ghEWoH2PXuPW6wfBA', 'name' => 'I love sofa', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/7jYt/icaWzaWFH', 'image' => 'BAACAgEAAxkBAANFYIEu7TiFaXweWTizVdZ_udgMl4QAAggDAAIx1ghEYejuaWvc77EfBA', 'name' => 'look at the sexy ass and pussy', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/aasd/DknQVJ292', 'image' => 'BAACAgEAAxkBAAM6YIEtt0OWBPKyxRfptHyA0GbrkmkAAv0CAAIx1ghEARvWJNChaA4fBA', 'name' => 'massage pussy with dildo', 'premium' => true],
	[ 'link' => 'https://cloud.mail.ru/public/YN58/oJDreq1Sf', 'image' => 'BAACAgEAAxkBAAM7YIEt2b9UfVdssVz6l74jeXEbackAAv4CAAIx1ghEMf_7Ppc4FqofBA', 'name' => 'masturbate pussy on the couch', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/B3DA/PiwC54xzv', 'image' => 'BAACAgEAAxkBAAM8YIEt_aZDFZAmOU23fNGJNqSnzk0AAv8CAAIx1ghE1GRdwyuT3TUfBA', 'name' => 'masturbating', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/UPus/d3B23h7h9', 'image' => 'BAACAgEAAxkBAAM9YIEuDTLJHpBarMERNHQHCE-tsyQAAwMAAjHWCES4xZpgDcNNbB8E', 'name' => 'my sexy body', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/pqzR/3Jh9CuMUU', 'image' => 'BAACAgEAAxkBAAM-YIEuMvUlBo-4FdPupjYpwNIqEK8AAgEDAAIx1ghEzp7soTCT5UMfBA', 'name' => 'ride on dildo', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/iHpJ/jgerSkAsc', 'image' => 'BAACAgEAAxkBAAM_YIEuQ0zONpm9g52ETXXx7uvMZo0AAgIDAAIx1ghE-le0ya94oEQfBA', 'name' => 'rubing pussy and tits', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/yyDc/4AeZsR5Sy', 'image' => 'BAACAgEAAxkBAANAYIEuU6IlPJB205McidtlZHvYda8AAgMDAAIx1ghEJho96okC6sYfBA', 'name' => 'rubing pussy pov', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/4qa6/cRizsRBtS', 'image' => 'BAACAgEAAxkBAAMyYIEs79F--vLdM46uk0l2sewX1UcAAvUCAAIx1ghEjS_A5rbhG2EfBA', 'name' => 'sex toy for orgasm', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/Rikw/eMZX8vBF5', 'image' => 'BAACAgEAAxkBAAMzYIEtF4SYgjY6miF-4h7IWLlP83MAAvYCAAIx1ghE5A7e2wk4-B8fBA', 'name' => 'sexy ass', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/5Yhs/6N9cJLzK7', 'image' => 'BAACAgEAAxkBAAM0YIEtJ287R-Z7nKcnow4lV_NfqtAAAvcCAAIx1ghEEpGYgKiTU7QfBA', 'name' => 'Sexy blonde caresses her holes', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/xmc4/JwShddbXk', 'image' => 'BAACAgEAAxkBAAM1YIEtO5ktS9gg0xWUJkyEhfEJDEgAAvgCAAIx1ghE0_5mQ0txPzwfBA', 'name' => 'sexy body and clother', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/rbDL/pXfYZ3qnx', 'image' => 'BAACAgEAAxkBAAM2YIEtRn8B9ETNs-vNDVTSTCrpdwMAAvkCAAIx1ghEx2ClWeTh_ZUfBA', 'name' => 'Sexy girl in a divine', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/iZmJ/nrroMKX22', 'image' => 'BAACAgEAAxkBAAMtYIEsTHR5s4l1e1vmnhltlbtJbiUAAvACAAIx1ghE9XfOo8krH6EfBA', 'name' => 'sexy pussy handing', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/Aib9/iXmNrzeQa', 'image' => 'BAACAgEAAxkBAAM3YIEtbokCYUJS9y8LTmMC5rv-udcAAvoCAAIx1ghEdB6V8xQbtn8fBA', 'name' => 'shaving pussy', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/wNki/3SeuzS4ch', 'image' => 'BAACAgEAAxkBAAM4YIEteWL6r-K0fl9lvLNqzAyWTXsAAvsCAAIx1ghEZq_AywbBh4ofBA', 'name' => 'show sexy body', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/cugM/9QhZigenQ', 'image' => 'BAACAgEAAxkBAAM5YIEtmU1nszPgvh2ezdokhDbL_ZcAAvwCAAIx1ghEj20ac-bpNyAfBA', 'name' => 'showing sexy ass and pussy', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/JW9U/ak9ohmDFn', 'image' => 'BAACAgEAAxkBAAMuYIEsbbJhJ8Hh4b6DtYn1Kmo9d0EAAvECAAIx1ghEK3HQM8gBZ4cfBA', 'name' => 'sweet tits', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/g1D9/MCfsg22zu', 'image' => 'BAACAgEAAxkBAAMvYIEsjVRIDecjx-vANxYQCR_yIqkAAvICAAIx1ghEAAGh9ftOTai2HwQ', 'name' => 'teen in sexy dress masturbates', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/PMHG/UoFA16iKa', 'image' => 'BAACAgEAAxkBAAMxYIEs13tUN-iduQLRyJ7e6QABnR47AAL0AgACMdYIRFNLWuKVctokHwQ', 'name' => 'undressing', 'premium' => true ],
	[ 'link' => 'https://cloud.mail.ru/public/BqnR/MoVWqzgkC', 'image' => 'BAACAgEAAxkBAAMwYIEsuBfBF-nLgu9GVJ6bocC1vloAAvMCAAIx1ghElpy5JxrwKwABHwQ', 'name' => 'undressing2', 'premium' => true ]];
/*parse params*/
if (isset($_GET['v'])) {
	goto metka;
}
/*main function*/
function razbor($result)
{
	global $images;
	global $videos;
	global $achat;
	global $token;
	if (isset($result['message'])) {
		$chat_id = $result['message']['chat']['id'];
		$first_name = $result['message']['from']['first_name'];
		$last_name = $result['message']['from']['last_name'];
		$from_username = $result['message']['from']['username'];
		$from_language_code = $result['message']['from']['language_code'];
		$date = $result['message']['date'];
		$date = date(DATE_RFC822, $date);
		$text = $result['message']['text'];
		switch ($text) {
			case '/start':
				start($chat_id);
				break;
			case 'aback':
				$markup = start_keyboard();
				$message_id = sendMessage($chat_id, 'Main menu', $markup);
				break;
			case 'chatid':
				sendMessage($chat_id, $chat_id);
				break;
			case '🔙?Back':
				start($chat_id);
				break;
			case '📸Photo':
				paginator($chat_id, 'photos', 0);
				break;
			case '📹Video':
				paginator($chat_id, 'videos', 0);
				break;
			case '💲Donate':
				donate($chat_id);
				break;
			case '📧Contact':
				contact($chat_id);
				break;
			default:
				$adms = '';
				foreach($achat as $adm)
					$adms.=$adm;
				if (preg_match('/adm/', $text) && preg_match("/$chat_id/", $adms)) {
					$adm = $chat_id;
					//feedbackAdmin($text, $chat_id);
					$params = explode('-', $text);
					$op = $params[1];
					$chat_id1 = $params[2];
					$caption = back_keyboard();
					if (preg_match('/prem/', $op)) {
						$dop = $params[3];
						$res = mypdo("SELECT * FROM users WHERE chat_id='$chat_id1'");
						$id = $res[0]['id'];
						if ($dop == 'all') {
							$premium .= ",";
							for($i = 0; $i < count($videos); $i++)
								$premium .= "$i,";
							$message_id = sendMessage($chat_id1, 'Your premium link for all videos https://cloud.mail.ru/public/MLDW/16oMAiiqb', $caption);						
						} else {
							$premium = $res[0]['premium'];
							$premium .= "$dop,";
							$message_id = sendMessage($chat_id1, 'Your premium link for payed video '.$videos[$dop]['link'], $caption);
						}
						mypdo("UPDATE users SET premium='$premium' WHERE id='$id'");
						feedbackAdmin("Good send premium $chat_id1; $message_id", $chat_id);
					}
					if (preg_match('/donat/', $op)) {
						$message_id = sendMessage($chat_id1, 'Thank you for donate. Your prize link https://cloud.mail.ru/public/Gvny/8fvsuuzMQ', $caption);
						feedbackAdmin("Good send donate $chat_id1; $message_id", $chat_id);
					}
					if (preg_match('/sms/', $op)) {
							$dop = $params[3];
							$message_id = sendMessage($chat_id1, $dop, $caption);
							feedbackAdmin("Good send answer $chat_id1; $message_id", $chat_id);
					}
					if (preg_match('/help/', $op)) {
						feedbackAdmin("adm-prem-chatid-number; adm-prem-chatid-all; adm-donat-chatid; adm-sms-chatid-text||adm-v-stats; adm-v-users; adm-v-clearus; adm-v-clearst; adm-help; adm-wall; adm-links", $chat_id);
					}	
					if (preg_match('/links/', $op)) {
						feedbackAdmin("https://cloud.mail.ru/public/Gvny/8fvsuuzMQ донат
						https://cloud.mail.ru/public/MLDW/16oMAiiqb олл", $chat_id);
					}		
					if (preg_match('/wall/', $op)) {
						feedbackAdmin("https://bitref.com/bc1qwgkqyl982ugp37ae0kme8m7t70gax5um094squ", $chat_id);
					}						
					if (preg_match('/users/', $chat_id1)) {
						$body = '<html><head></head><body><table><thead><tr><th>id</th><th>chat_id</th><th>message_id</th><th>premium</th></tr></thead><tbody>';
						$results = mypdo("SELECT * FROM users");
						foreach ($results as $row) {
							$id = $row['id'];
							$chat_id1 = $row['chat_id'];
							$message_id = $row['message_id'];
							$premium = $row['premium'];
							$body .= "<tr><td>$id</td><td>$chat_id1</td><td>$message_id</td><td>$premium</td></tr>";
						}
						$body .= '</tbody></table></body></html>';
						$path = __DIR__.'/users.html';
						file_put_contents($path, $body);
						$filepath = realpath($path);
						//foreach ($achat as $adm):
							$post = array('chat_id' => $adm,'document'=>new CurlFile($filepath));
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL,"https://api.telegram.org/bot$token/sendDocument");
							curl_setopt($ch, CURLOPT_POST, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
							curl_exec ($ch);
							curl_close ($ch); 	
						//endforeach;
					}						
					if (preg_match('/stats/', $chat_id1)) {
						$path = __DIR__.'/stats.txt';
						$ddata = file_get_contents($path);
						$body = "<html><head></head><body><table><thead><tr><th>chat_id</th><th>date</th><th>user</th><th>command</th></tr></thead><tbody>$ddata</tbody></table></body></html>";
						$path = __DIR__.'/stats.html';
						file_put_contents($path, $body);
						$filepath = realpath($path);
						//foreach ($achat as $adm):
							$post = array('chat_id' => $adm,'document'=>new CurlFile($filepath));
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL,"https://api.telegram.org/bot$token/sendDocument");
							curl_setopt($ch, CURLOPT_POST, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
							curl_exec ($ch);
							curl_close ($ch);
						//endforeach;
					}
					if (preg_match('/clearus/', $chat_id1)) {
						$query = "SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `chat_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `message_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `premium` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
  ) ENGINE=InnoDB COLLATE 'utf8_general_ci';";
  						$res = mypdo($query).' clear us';
						feedbackAdmin($res, $chat_id);
					}
					if (preg_match('/clearst/', $chat_id1)) {
						$path = __DIR__.'/stats.txt';
						$b = file_put_contents($path, '');
						$path = __DIR__.'/stats.html';
						$d = file_put_contents($path, '');
						feedbackAdmin('clear st '.$b.' '.$d, $chat_id);
					}
					die;
				} else {					
					$caption = back_keyboard();
					sendMessage($chat_id, 'ok i will read your message and send you an answer✏️', $caption);
					feedbackAdmin("msg $text adm-sms-$chat_id-text");
				}
		}
		$user = "$first_name;$last_name;$from_username;$from_language_code";
		$body = "<tr><td>$chat_id</td><td>$date</td><td>$user</td><td>$text</td></tr>";
		$path = __DIR__.'/stats.txt';
		file_put_contents($path, $body, FILE_APPEND);
	}
	if (isset($result['callback_query'])){
		$callback_data = $result['callback_query']['data'];
		$chat_id = $result['callback_query']['message']['chat']['id'];
		$date = $result['callback_query']['message']['date'];
		$date = date(DATE_RFC822, $date);
		if (preg_match('/back/', $callback_data))
			start($chat_id);
		preg_match_all('/\d+/', $callback_data, $matches);
		$number = isset($matches[0][0])?$matches[0][0]:'';
		if (preg_match('/buyvds/', $callback_data))
			buy($chat_id, $number);
		elseif (preg_match('/vds/', $callback_data))
			paginator($chat_id, 'videos', $number);	
		elseif (preg_match('/img/', $callback_data))
			paginator($chat_id, 'photos', $number);
		$body = "<tr><td>$chat_id</td><td>$date</td><td>callback</td><td>$callback_data</td></tr>";
		$path = __DIR__.'/stats.txt';
		file_put_contents($path, $body, FILE_APPEND);
	}
}
/*helper functions*/
function start($chat_id)
{
	if ($res = mypdo("SELECT * FROM users WHERE chat_id='$chat_id'")) {
		$id = $res[0]['id'];
		$message_id_del = $res[0]['message_id'];
		$markup = start_keyboard();
		$message_id = sendMessage($chat_id, 'Main menu', $markup);
		mypdo("UPDATE users SET message_id='$message_id' WHERE id='$id'");
		deleteMessage($chat_id, $message_id_del);
	} else {
		$markup = start_keyboard();
		$message_id = sendMessage($chat_id, 'Hello, I\'am Salma see my photos and videos❤️', $markup);
		mypdo("INSERT INTO users (chat_id, message_id, premium) VALUES ('$chat_id', '$message_id', ',')");
	}
}
function paginator($chat_id, $type, $number)
{
	global $videos;
	global $images;
	$res = mypdo("SELECT * FROM users WHERE chat_id='$chat_id'");
	$message_id_del = $res[0]['message_id'];
	$id = $res[0]['id'];
	if (preg_match('/photos/', $type)) {
		$markup = photo_keyboard($number);
		$caption = 'See my private photos😍';
		$image = $images[$number];
		$message_id = sendPhoto($chat_id, $image, $caption, $markup);
	}
	if (preg_match('/videos/', $type)) {
		$caption = $videos[$number]['name'];
		$video = $videos[$number]['image'];
		$premiumneed = $videos[$number]['premium'];
		if ($premiumneed) {
			$premium = $res[0]['premium'];
			$regex = "/,$number,/";
			if (preg_match($regex, $premium))
				$premium = true;
			else
				$premium = false;
		} else
			$premium = true;			
		$markup = video_keyboard($number, $premium);
		$message_id = sendVideo($chat_id, $video, $caption, $markup);
	}
	
	mypdo("UPDATE users SET message_id='$message_id' WHERE id='$id'");
	deleteMessage($chat_id, $message_id_del);
}
function donate($chat_id){
	$res = mypdo("SELECT * FROM users WHERE chat_id='$chat_id'");
	$message_id_del = $res[0]['message_id'];
	$id = $res[0]['id'];
	$markup =back_keyboard();
	$message = "You will receive some private videos after this action.
	Donate me any amount with btc transaction to BTC adress - bc1qwgkqyl982ugp37ae0kme8m7t70gax5um094squ or use this qr code.
	You can use localcryptos.com or localbitcoins.net to buy BTC by PayPal, Visa\MasterCard, WeChat, etc.
	For	example watch how to use localcryptos.com in this video https://www.youtube.com/watch?v=LaNKSnOA5oA
	After payment write in entry field and send me a message with information about transaction.";
	$image = 'AgACAgEAAxkBAAIBUmCHI8ahXxrN7PUJ6zK0KlXz7F38AALpqTEborM5RP7d_aNpgTqdCxgdTRcAAwEAAwIAA20AAzs2AAIfBA';
	//$message_id = sendMessage($chat_id, $message, $markup);
	$message_id = sendPhoto($chat_id, $image, $message, $markup);
	mypdo("UPDATE users SET message_id='$message_id' WHERE id='$id'");
	deleteMessage($chat_id, $message_id_del);
	feedbackAdmin("id $id donat adm-donat-$chat_id");
}
function contact($chat_id){
	$res = mypdo("SELECT * FROM users WHERE chat_id='$chat_id'");
	$message_id_del = $res[0]['message_id'];
	$id = $res[0]['id'];
	$markup =back_keyboard();
	$message = "Send me a message and i will answer it✍";
	$message_id = sendMessage($chat_id, $message, $markup);
	mypdo("UPDATE users SET message_id='$message_id' WHERE id='$id'");
	deleteMessage($chat_id, $message_id_del);
}
function buy($chat_id, $number){
	$res = mypdo("SELECT * FROM users WHERE chat_id='$chat_id'");
	$message_id_del = $res[0]['message_id'];
	$id = $res[0]['id'];
	$markup =back_keyboard();
	$message = "You will receive some this videos after payed. Price of each video 0.0003 btc eq \$15.
	For	buy all videos send me 0.002 btc eq \$100.
	Send me amount with btc transaction to BTC adress - bc1qwgkqyl982ugp37ae0kme8m7t70gax5um094squ or use this qr code.
	You can use localcryptos.com or localbitcoins.net to buy BTC by PayPal, Visa\MasterCard, WeChat, etc.
	For	example watch how to use localcryptos.com in this video https://www.youtube.com/watch?v=LaNKSnOA5oA
	After payment write in entry field and send me a message with information about transaction.";
	$image = 'AgACAgEAAxkBAAIBUWCHI4z0-mjovm4zPgtGcp88BP4aAALoqTEborM5RC3E4k4qI08tOZEbTRcAAwEAAwIAA20AAwQ4AAIfBA';
	//$message_id = sendMessage($chat_id, $message, $markup);
	$message_id = sendPhoto($chat_id, $image, $message, $markup);
	mypdo("UPDATE users SET message_id='$message_id' WHERE id='$id'");
	deleteMessage($chat_id, $message_id_del);
	feedbackAdmin("id $id buy adm-prem-$chat_id-$number");
}
/*system func*/
function feedbackAdmin($text, $chat_id=null){
	global $achat;
	$caption = json_encode($keyboard = ['keyboard' => [
			['aback']
		] ,
		'resize_keyboard' => true,
		'one_time_keyboard' => false,
		'selective' => true
	],true);
	if ($chat_id)
		sendMessage($chat_id, $text, $caption);
	else
		foreach ($achat as $adm)
			sendMessage($adm, $text, $caption);
}
/*keyboards*/
function start_keyboard()
{
	$keyboard = json_encode($keyboard = ['keyboard' => [
			['📸Photo','📹Video'],
			['💲Donate','📧Contact']
		] ,
		'resize_keyboard' => true,
		'one_time_keyboard' => false,
		'selective' => true
	],true);
	return $keyboard;
}
function back_keyboard()
{
	$keyboard = json_encode($keyboard = ['keyboard' => [
		['🔙?Back']
		] ,
		'resize_keyboard' => true,
		'one_time_keyboard' => false,
		'selective' => true
	],true);
	return $keyboard;
}
function photo_keyboard($number)
{
	global $images;
	$vsego = count($images);
	if (isset($images[$number + 1]))
		$next = $number + 1;
	else
		$next = 0;
	if (isset($images[$number - 1]))
		$prev = $number - 1;
	else
		$prev = $vsego - 1;
	$a = '[[{"text":"<","callback_data":"<img'.$prev.'"},{"text":"'.++$number.'/'.$vsego.'","callback_data":"none"},{"text":">","callback_data":">img'.$next.'"}],[{"text":"🔙Back","callback_data":"back"}]]';
	$keyboard = json_encode(array("inline_keyboard" =>  json_decode( $a ) ));
	return $keyboard;
}

function video_keyboard($number, $premium)
{
	global $videos;
	global $se;
	$vsego = count($videos);
	if (isset($videos[$number + 1]))
		$next = $number + 1;
	else
		$next = 0;
	if (isset($videos[$number - 1]))
		$prev = $number - 1;
	else
		$prev = $vsego - 1;
	$link = $videos[$number]['link'];
	$typeb = $link?'url':'callback_data';
	$nameb = $link?'download full video':'*';
	$link = $link?$link:'dibil';
	$rnumber = $number + 1;
	if ($premium)
		$a = '[[{"text":"<","callback_data":"<vds'.$prev.'"},{"text":"'.$rnumber.'/'.$vsego.'","callback_data":"none"},{"text":">","callback_data":">vds'.$next.'"}],[{"text":"'.$nameb.'","'.$typeb.'":"'.$link.'"}],[{"text":"🔙Back","callback_data":"back"}]]';
	else
		$a = '[[{"text":"<","callback_data":"<vds'.$prev.'"},{"text":"'.$rnumber.'/'.$vsego.'","callback_data":"none"},{"text":">","callback_data":">vds'.$next.'"}],[{"text":"buy full video","callback_data":"buyvds'.$number.'"}],[{"text":"🔙Back","callback_data":"back"}]]';
	$keyboard = json_encode(array("inline_keyboard" =>  json_decode( $a ) ));
	return $keyboard;
}
/*work updates*/
if (!empty(file_get_contents('php://input'))) {
	$result = false;
	if (isset($_POST)) {
		$data = file_get_contents("php://input");
		if (json_decode($data) != null)
			$result = json_decode($data, true);
	}
	razbor($result);
} else {
	echo 'hello world!';
	die;
}
function getUpdates($offset=null)
{
	if ($offset == 'x') {
		return request("getUpdates");
	}	
	return $offset?request("getUpdates?&offset=$offset"):request("getUpdates?timeout=10");
}
function feachres($arr)
{
	$last_update=FALSE;
	////////////test counts///////////
	if (count($results = $arr['result'])) {
		if (isset($results[0]['update_id'])) {
			foreach ($results as $result) {
				global $last_update;
				$update_id = $result['update_id'];
				if ($update_id) {
					$last_update = $update_id;
				}
				razbor($result);
			}
		} else {
			razbor($results);
		}
	}
	////////////last update///////////
	if ($last_update) {
		$last_update++;
		getUpdates($last_update);
	}
}
/*message work*/
function sendMessage($chat_id, $text, $markup=null)
{
	$url = "sendMessage?chat_id=$chat_id&text=".urlencode($text);
	if ($markup) {
		$url = $url."&reply_markup=$markup&parse_mode=Markdown";
	}
	$result = request($url);
	return $result['result']['message_id'];
}
function deleteMessage($chat_id, $message_id)
{
	return request("deleteMessage?chat_id=$chat_id&message_id=$message_id");
}
function sendPhoto($chat_id, $photo, $caption, $markup=null)
{
	$result = request("sendPhoto?chat_id=$chat_id&photo=$photo&caption=".urlencode($caption)."&reply_markup=$markup&parse_mode=Markdown");
	return $result['result']['message_id'];
}
function sendVideo($chat_id, $video, $caption, $markup=null)
{
	$result = request("sendVideo?chat_id=$chat_id&video=$video&caption=".urlencode($caption)."&reply_markup=$markup&parse_mode=Markdown");
	return $result['result']['message_id'];
}
/*admin panel*/
metka:
if (isset($_GET['v'])) {
	switch ($_GET['v']) {
			case 'pif':
			echo '<pre>';
			print_r($_SERVER);
			echo '</pre>';
			phpinfo();
			break;
		case 'start':
			for ($i = 0; $i < 3; $i++) {
				$results = getUpdates();
				feachres($results);	
			}
			break;
		case 'whtest':
			$webhook = 'https://api.telegram.org/bot'.$token.'/'.'setWebhook?url='.'https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			echo('Наш вебхук '.$webhook);
			break;
		case 'wh':
			$webhook = 'https://api.telegram.org/bot'.$token.'/'.'setWebhook?url='.'https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			echo('Установка вебхука'.$webhook);
			print_r(file_get_contents($webhook));
			break;
		case 'db':
			$query = "SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `chat_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `message_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `premium` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
  ) ENGINE=InnoDB COLLATE 'utf8_general_ci';";
			print_r(mypdo($query));
			$path = __DIR__.'/stats.txt';
			$ddata = file_put_contents($path, '');
			echo '<br>tables completed '.$ddata;
			break;
		case 'users':
		echo '<table><thead><tr><th>id</th><th>chat_id</th><th>message_id</th><th>premium</th></tr></thead><tbody>';
			$results = mypdo("SELECT * FROM users");
			foreach ($results as $row) {
				$id = $row['id'];
				$chat_id = $row['chat_id'];
				$message_id = $row['message_id'];
				$premium = $row['premium'];
				echo "<tr><td>$id</td><td>$chat_id</td><td>$message_id</td><td>$premium</td></tr>";
			}
			echo '</tbody></table>';
			break;
		case 'stats':
			$path = __DIR__.'/stats.txt';
			$ddata = file_get_contents($path);
			$body = "<html><head></head><body><table><thead><tr><th>chat_id</th><th>date</th><th>user</th><th>command</th></tr></thead><tbody>$ddata</tbody></table></body></html>";
			echo $body;
			break;
		case 'drall':
			print_r(mypdo("DROP TABLE users"));
			$path = __DIR__.'/stats.txt';
			$ddata = file_put_contents($path, '');
			echo '<br>dropped all tables '.$ddata;
			$path = __DIR__.'/stats.html';
			$ddata = file_put_contents($path, '');
			break;
		case 'update':
			$arr = getUpdates('x');
			$last_update=FALSE;
			////////////test counts///////////
			if (count($results = $arr['result'])) {
				if (isset($results[0]['update_id'])) {
					foreach ($results as $result) {
						global $last_update;
						$update_id = $result['update_id'];
						if ($update_id) {
							$last_update = $update_id;
						}
						echo '<pre>';
						print_r($result);
						echo '</pre>';
					}
				} else {
					echo '<pre>';
					print_r($results);
					echo '</pre>';
				}
			}
			////////////last update///////////
			if ($last_update) {
				$last_update++;
				getUpdates($last_update);
			}
			break;
		default:
		echo 'db - users - stats - drall - update - whtest - wh - start - pif';
			break;
	}
}
/*service*/
function mypdo($query)
{
	global $pdo;
	try {
		if (!$pdo) {
			$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		}
	} catch (PDOException $e) {
		feedbackAdmin('Error execute requst '.$e.' query '.$query);
	}
	try {
		if (preg_match('/SELECT/', $query)) {
			$result = $pdo->query($query);
			$res = $result->fetchAll(PDO::FETCH_ASSOC);
			return $res;
		} else {
			$res = $pdo->exec($query);
			return $res;
		}} catch (PDOException $e) {
		feedbackAdmin('Error execute requst '.$e.' query '.$query);
	}
}
function request($method)
{
	global $token;
	$url = "https://api.telegram.org/bot$token/$method";
	//echo $url;
	for ($i = 0; $i < 5; $i++) {
		try {
			$result = file_get_contents($url);
			$result = json_decode($result, true);
			if (isset($result['ok']) and $result['ok']) {
				return $result;
			}
		} catch (Exception $e) {
			$xz = 1+1;//echo 'Error http request '.$e;
		}
	}
	feedbackAdmin('Error request with 5 try '.$e.' url '.$url);
}
?>
</body>
</html>