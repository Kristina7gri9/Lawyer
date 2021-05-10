<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['formid']) && $_POST['formid'] == 'indexlayer6')
{
   $mailto = 'lawfirstofall@yandex.ru';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $mailcc = 'zimin1395@mail.ru';
   $subject = 'Заявка с сайта';
   $message = 'Контактные данные:';
   $success_url = './uspeh.php';
   $error_url = './index.php';
   $eol = "\n";
   $error = '';
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'Cc: '.$mailcc.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   try
   {
      if (!ValidateEmail($mailfrom))
      {
         $error .= "The specified email address (" . $mailfrom . ") is invalid!\n<br>";
         throw new Exception($error);
      }
      $message .= $eol;
      $message .= "IP Address : ";
      $message .= $_SERVER['REMOTE_ADDR'];
      $message .= $eol;
      foreach ($_POST as $key => $value)
      {
         if (!in_array(strtolower($key), $internalfields))
         {
            if (!is_array($value))
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
            }
            else
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
            }
         }
      }
      $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
      $body .= '--'.$boundary.$eol;
      $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
      $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
      $body .= $eol.stripslashes($message).$eol;
      if (!empty($_FILES))
      {
         foreach ($_FILES as $key => $value)
         {
             if ($_FILES[$key]['error'] == 0)
             {
                $body .= '--'.$boundary.$eol;
                $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
                $body .= 'Content-Transfer-Encoding: base64'.$eol;
                $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
                $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
             }
         }
      }
      $body .= '--'.$boundary.'--'.$eol;
      if ($mailto != '')
      {
         mail($mailto, $subject, $body, $header);
      }
      header('Location: '.$success_url);
   }
   catch (Exception $e)
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $e->getMessage(), $errorcode);
      echo $errorcode;
   }
   exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['formid']) && $_POST['formid'] == 'indexform3')
{
   $mailto = 'lawfirstofall@yandex.ru';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $mailcc = 'zimin1395@mail.ru';
   $subject = 'Заказ звонка с сайта';
   $message = 'Контактные данные:';
   $success_url = './uspeh.php';
   $error_url = './index.php';
   $eol = "\n";
   $error = '';
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'Cc: '.$mailcc.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   try
   {
      if (!ValidateEmail($mailfrom))
      {
         $error .= "The specified email address (" . $mailfrom . ") is invalid!\n<br>";
         throw new Exception($error);
      }
      foreach ($_POST as $key => $value)
      {
         if (preg_match('/www\.|http:|https:/i', $value))
         {
            $error .= "URLs are not allowed!\n<br>";
            throw new Exception($error);
            break;
         }
      }
      $message .= $eol;
      $message .= "IP Address : ";
      $message .= $_SERVER['REMOTE_ADDR'];
      $message .= $eol;
      foreach ($_POST as $key => $value)
      {
         if (!in_array(strtolower($key), $internalfields))
         {
            if (!is_array($value))
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
            }
            else
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
            }
         }
      }
      $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
      $body .= '--'.$boundary.$eol;
      $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
      $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
      $body .= $eol.stripslashes($message).$eol;
      if (!empty($_FILES))
      {
         foreach ($_FILES as $key => $value)
         {
             if ($_FILES[$key]['error'] == 0)
             {
                $body .= '--'.$boundary.$eol;
                $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
                $body .= 'Content-Transfer-Encoding: base64'.$eol;
                $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
                $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
             }
         }
      }
      $body .= '--'.$boundary.'--'.$eol;
      if ($mailto != '')
      {
         mail($mailto, $subject, $body, $header);
      }
      header('Location: '.$success_url);
   }
   catch (Exception $e)
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $e->getMessage(), $errorcode);
      echo $errorcode;
   }
   exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Адвокаты и юристы г. Москва</title>
<meta name="description" content="Сопровождаем арбитражные споры и решаем любые юридические вопросы">
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="1 day">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://arbitralmsc.ru/" rel="canonical">
<link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
<link href="style/base/jquery-ui.min.css" rel="stylesheet">
<link href="style/site.css" rel="stylesheet">
<link href="style/voprosy.css" rel="stylesheet">
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/util.min.js"></script>
<script src="js/modal.min.js"></script>
<script src="js/wwb15.min.js"></script>
<script src="js/voprosy.js"></script>
</head>
<body>
   <div id="space"><br></div>
   <div id="container">
      <form name="indexLayer6" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexLayer6">
         <input type="hidden" name="formid" value="indexlayer6">
         <div id="indexLayer6_Container">
            <div id="wb_indexText29">
               <span id="wb_uid0">© Arbitralmsc.ru, 2020 г.</span></div>
            <div id="wb_indexText30">
               <span id="wb_uid1"><a href="politika.pdf" class="phone" target="_blank">Политика конфиденциальности</a></span></div>
            <div id="wb_indexText31">
               <span id="wb_uid2">info@arbitralmsc.ru</span></div>
            <div id="wb_indexText2">
               <span id="wb_uid3"><a href="#" class="zvonok" onclick="$('#modal_zvonok').modal('show');return false;">Закажите звонок от нас</a></span></div>
            <div id="wb_indexText9">
               <span id="wb_uid4"><a href="./index.php" class="logo">Адвокаты и юристы г. Москва</a></span></div>
            <div id="indexLayer1" onclick="window.location.href='./index.php';return false;">
               <div id="indexLayer1_Container">
               </div>
            </div>
            <div id="indexLayer7">
               <div id="indexLayer7_Container">
               </div>
            </div>
            <div id="wb_indexText1">
               <span id="wb_uid5"><a href="tel:+79080007564" class="phone">+7 (908) 000-75-64</a></span></div>
            <div id="voprosy1">
               <div id="voprosy1_Container">
                  <div id="wb_indexText8">
                     <span id="wb_uid6">1. Какая услуга Вас интересует?</span></div>
                  <label><div id="voprosyLayer1" onmouseover="SetStyle('voprosyLayer1', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer1', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer1_Container">
                           <div id="wb_voprosyRadioButton1">
                              <input type="radio" id="voprosyRadioButton1" name="1. Какая услуга Вас интересует?" value="Консультация"><label for="voprosyRadioButton1"></label></div>
                           <div id="wb_indexText4">
                              <span id="wb_uid7">Консультация</span></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer2" onmouseover="SetStyle('voprosyLayer2', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer2', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer2_Container">
                           <div id="wb_voprosyText1">
                              <span id="wb_uid8">Составление или экспертиза договора</span></div>
                           <div id="wb_voprosyRadioButton2">
                              <input type="radio" id="voprosyRadioButton2" name="1. Какая услуга Вас интересует?" value="Составление или экспертиза договора"><label for="voprosyRadioButton2"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer3" onmouseover="SetStyle('voprosyLayer3', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer3', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer3_Container">
                           <div id="wb_voprosyText2">
                              <span id="wb_uid9">Представительство в суде</span></div>
                           <div id="wb_voprosyRadioButton3">
                              <input type="radio" id="voprosyRadioButton3" name="1. Какая услуга Вас интересует?" value="Представительство в суде"><label for="voprosyRadioButton3"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer4" onmouseover="SetStyle('voprosyLayer4', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer4', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer4_Container">
                           <div id="wb_voprosyRadioButton4">
                              <input type="radio" id="voprosyRadioButton4" name="1. Какая услуга Вас интересует?" value="Составление документов (заявление, жалоб, претензий)"><label for="voprosyRadioButton4"></label></div>
                           <div id="wb_voprosyText3">
                              <span id="wb_uid10">Составление документов (заявление, жалоб, претензий)</span></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer5" onmouseover="SetStyle('voprosyLayer5', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer5', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer5_Container">
                           <div id="wb_voprosyText4">
                              <span id="wb_uid11">Другая услуга</span></div>
                           <div id="wb_voprosyRadioButton5">
                              <input type="radio" id="voprosyRadioButton5" name="1. Какая услуга Вас интересует?" value="Другая услуга"><label for="voprosyRadioButton5"></label></div>
                        </div>
                     </div></label>
                  <div id="voprosyProgressbar1">
                     <div id="voprosyProgressbar1-label">10%</div>
                  </div>
               </div>
            </div>
            <div id="voprosy3_1">
               <div id="voprosy3_1_Container">
                  <div id="voprosyProgressbar3">
                     <div id="voprosyProgressbar3-label">67%</div>
                  </div>
                  <div id="wb_voprosyText10">
                     <span id="wb_uid12">3. Какая форма оказания консультации Вам предпочтительна?</span></div>
                  <label><div id="voprosyLayer12" onmouseover="SetStyle('voprosyLayer12', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer12', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer12_Container">
                           <div id="wb_voprosyText12">
                              <span id="wb_uid13">Устная</span></div>
                           <div id="wb_voprosyRadioButton11">
                              <input type="radio" id="voprosyRadioButton11" name="3. Какая форма оказания консультации Вам предпочтительна?" value="Устная"><label for="voprosyRadioButton11"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer11" onmouseover="SetStyle('voprosyLayer11', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer11', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer11_Container">
                           <div id="wb_voprosyText11">
                              <span id="wb_uid14">Письменная</span></div>
                           <div id="wb_voprosyRadioButton10">
                              <input type="radio" id="voprosyRadioButton10" name="3. Какая форма оказания консультации Вам предпочтительна?" value="Письменная"><label for="voprosyRadioButton10"></label></div>
                        </div>
                     </div></label>
               </div>
            </div>
            <div id="voprosy_itog">
               <div id="voprosy_itog_Container">
                  <div id="wb_indexText3">
                     <span id="wb_uid15">Последний шаг</span></div>
                  <div id="voprosyProgressbar4">
                     <div id="voprosyProgressbar4-label">100%</div>
                  </div>
                  <div id="wb_voprosyText13">
                     <span id="wb_uid16"><strong>Заполните форму </strong></span><span id="wb_uid17">прямо сейчас и получите бесплатную оценку перспектив по вашему делу</span></div>
                  <div id="voprosyLayer10" class="blick-button">
                     <div id="voprosyLayer10_Container">
                        <input type="submit" id="voprosyButton1" onmouseover="SetStyle('voprosyButton1', 'knop1_2');return false;" onmouseout="SetStyle('voprosyButton1', 'knop1_1');return false;" name="" value="Получить оценку дела" class="knop1_1">
                     </div>
                  </div>
                  <input type="text" id="voprosyEditbox1" name="Телефон" value="" autocomplete="off" spellcheck="true" required placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1089;&#1074;&#1086;&#1081; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
                  <input type="text" id="voprosyEditbox2" name="Имя" value="" autocomplete="off" spellcheck="true" required pattern="[A-Za-zАБВГДЕЖЗИЙКЛМНОПРСТУФХЦШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцшщъыьэюя \t\r\n\fа,б,в,г,д,е,ё,ж,з,и,й,к,л,м,н,о,п,р,с,т,у,ф,х,ц,ч,ш,щ,ъ,ы,ь,э,ю,я,А,Б,В,Г,Д,Е,Ё,Ж,З,И,Й,К,Л,М,Н,О,П,Р,С,Т,У,Ф,Х,Ц,Ч,Ш,Щ,Ъ,Ы,Ь,Э,Ю,Я]*$" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1089;&#1074;&#1086;&#1077; &#1080;&#1084;&#1103;">
                  <div id="wb_voprosyText15" class="Oswald_ExtraLight">
                     <span id="wb_uid18">&#1053;&#1072;&#1078;&#1080;&#1084;&#1072;&#1103; &#1085;&#1072; &#1082;&#1085;&#1086;&#1087;&#1082;&#1091; &quot;Перезвоните мне&quot;, &#1103; &#1076;&#1072;&#1102; &#1089;&#1086;&#1075;&#1083;&#1072;&#1089;&#1080;&#1077; &#1085;&#1072; &#1086;&#1073;&#1088;&#1072;&#1073;&#1086;&#1090;&#1082;&#1091; &#1087;&#1077;&#1088;&#1089;&#1086;&#1085;&#1072;&#1083;&#1100;&#1085;&#1099;&#1093; &#1076;&#1072;&#1085;&#1085;&#1099;&#1093; &#1080; &#1089;&#1086;&#1075;&#1083;&#1072;&#1096;&#1072;&#1102;&#1089;&#1100; c &#1091;&#1089;&#1083;&#1086;&#1074;&#1080;&#1103;&#1084;&#1080; <a href="politika.pdf" class="phone" target="_blank">&#1087;&#1086;&#1083;&#1080;&#1090;&#1080;&#1082;&#1080; &#1082;&#1086;&#1085;&#1092;&#1080;&#1076;&#1077;&#1085;&#1094;&#1080;&#1072;&#1083;&#1100;&#1085;&#1086;&#1089;&#1090;&#1080;</a></span></div>
                  <div id="wb_voprosyCheckbox12">
                     <input type="checkbox" id="voprosyCheckbox12" name="Политика конфидициальности" value="согласны" checked required><label for="voprosyCheckbox12"></label></div>
               </div>
            </div>
            <div id="voprosy2_2">
               <div id="voprosy2_2_Container">
                  <div id="voprosyProgressbar5">
                     <div id="voprosyProgressbar5-label">34%</div>
                  </div>
                  <div id="wb_voprosyText14">
                     <span id="wb_uid19">2. Укажите вид договора:</span></div>
                  <label><div id="voprosyLayer14" onmouseover="SetStyle('voprosyLayer14', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer14', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer14_Container">
                           <div id="wb_voprosyText16">
                              <span id="wb_uid20">Услуги</span></div>
                           <div id="wb_voprosyRadioButton12">
                              <input type="radio" id="voprosyRadioButton12" name="2. Укажите вид договора:" value="Услуги"><label for="voprosyRadioButton12"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer15" onmouseover="SetStyle('voprosyLayer15', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer15', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer15_Container">
                           <div id="wb_voprosyText17">
                              <span id="wb_uid21">Подряд</span></div>
                           <div id="wb_voprosyRadioButton13">
                              <input type="radio" id="voprosyRadioButton13" name="2. Укажите вид договора:" value="Подряд"><label for="voprosyRadioButton13"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer16" onmouseover="SetStyle('voprosyLayer16', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer16', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer16_Container">
                           <div id="wb_voprosyText18">
                              <span id="wb_uid22">Аренда</span></div>
                           <div id="wb_voprosyRadioButton14">
                              <input type="radio" id="voprosyRadioButton14" name="2. Укажите вид договора:" value="Аренда"><label for="voprosyRadioButton14"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer17" onmouseover="SetStyle('voprosyLayer17', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer17', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer17_Container">
                           <div id="wb_voprosyText19">
                              <span id="wb_uid23">Купли-продажа</span></div>
                           <div id="wb_voprosyRadioButton15">
                              <input type="radio" id="voprosyRadioButton15" name="2. Укажите вид договора:" value="Купли-продажа"><label for="voprosyRadioButton15"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer13" onmouseover="SetStyle('voprosyLayer13', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer13', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer13_Container">
                           <div id="wb_voprosyText20">
                              <span id="wb_uid24">Другое</span></div>
                           <div id="wb_voprosyRadioButton16">
                              <input type="radio" id="voprosyRadioButton16" name="2. Укажите вид договора:" value="Другое"><label for="voprosyRadioButton16"></label></div>
                        </div>
                     </div></label>
               </div>
            </div>
            <div id="voprosy3_2">
               <div id="voprosy3_2_Container">
                  <div id="voprosyProgressbar6">
                     <div id="voprosyProgressbar6-label">67%</div>
                  </div>
                  <div id="wb_voprosyText21">
                     <span id="wb_uid25">3. Укажите цену договора:</span></div>
                  <label><div id="voprosyLayer20" onmouseover="SetStyle('voprosyLayer20', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer20', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer20_Container">
                           <div id="wb_voprosyText23">
                              <span id="wb_uid26">Свыше 10 млн. руб.</span></div>
                           <div id="wb_voprosyRadioButton18">
                              <input type="radio" id="voprosyRadioButton18" name="3. Укажите цену договора:" value="Свыше 10 млн. руб."><label for="voprosyRadioButton18"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer21" onmouseover="SetStyle('voprosyLayer21', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer21', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer21_Container">
                           <div id="wb_voprosyText24">
                              <span id="wb_uid27">От 1 до 10 млн. руб.</span></div>
                           <div id="wb_voprosyRadioButton19">
                              <input type="radio" id="voprosyRadioButton19" name="3. Укажите цену договора:" value="От 1 до 10 млн. руб."><label for="voprosyRadioButton19"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer22" onmouseover="SetStyle('voprosyLayer22', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer22', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer22_Container">
                           <div id="wb_voprosyText25">
                              <span id="wb_uid28">До 1 млн. руб.</span></div>
                           <div id="wb_voprosyRadioButton20">
                              <input type="radio" id="voprosyRadioButton20" name="3. Укажите цену договора:" value="До 1 млн. руб."><label for="voprosyRadioButton20"></label></div>
                        </div>
                     </div></label>
               </div>
            </div>
            <div id="voprosy2_3">
               <div id="voprosy2_3_Container">
                  <div id="voprosyProgressbar7">
                     <div id="voprosyProgressbar7-label">20%</div>
                  </div>
                  <div id="wb_voprosyText22">
                     <span id="wb_uid29">2. Укажите вид спора:</span></div>
                  <label><div id="voprosyLayer19" onmouseover="SetStyle('voprosyLayer19', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer19', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer19_Container">
                           <div id="wb_voprosyText26">
                              <span id="wb_uid30">Банкротство</span></div>
                           <div id="wb_voprosyRadioButton17">
                              <input type="radio" id="voprosyRadioButton17" name="2. Укажите вид спора:" value="Банкротство"><label for="voprosyRadioButton17"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer23" onmouseover="SetStyle('voprosyLayer23', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer23', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer23_Container">
                           <div id="wb_voprosyText27">
                              <span id="wb_uid31">Налоги</span></div>
                           <div id="wb_voprosyRadioButton21">
                              <input type="radio" id="voprosyRadioButton21" name="2. Укажите вид спора:" value="Налоги"><label for="voprosyRadioButton21"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer24" onmouseover="SetStyle('voprosyLayer24', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer24', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer24_Container">
                           <div id="wb_voprosyText28">
                              <span id="wb_uid32">Корпоративные споры</span></div>
                           <div id="wb_voprosyRadioButton22">
                              <input type="radio" id="voprosyRadioButton22" name="2. Укажите вид спора:" value="Корпоративные споры"><label for="voprosyRadioButton22"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer25" onmouseover="SetStyle('voprosyLayer25', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer25', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer25_Container">
                           <div id="wb_voprosyText29">
                              <span id="wb_uid33">Договорные споры</span></div>
                           <div id="wb_voprosyRadioButton23">
                              <input type="radio" id="voprosyRadioButton23" name="2. Укажите вид спора:" value="Договорные споры"><label for="voprosyRadioButton23"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer26" onmouseover="SetStyle('voprosyLayer26', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer26', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer26_Container">
                           <div id="wb_voprosyText30">
                              <span id="wb_uid34">Другое</span></div>
                           <div id="wb_voprosyRadioButton24">
                              <input type="radio" id="voprosyRadioButton24" name="2. Укажите вид спора:" value="Другое"><label for="voprosyRadioButton24"></label></div>
                        </div>
                     </div></label>
               </div>
            </div>
            <div id="voprosy3_3">
               <div id="voprosy3_3_Container">
                  <div id="voprosyProgressbar8">
                     <div id="voprosyProgressbar8-label">40%</div>
                  </div>
                  <div id="wb_voprosyText31">
                     <span id="wb_uid35">3. На какой стадии Вы находитесь?</span></div>
                  <label><div id="voprosyLayer27" onmouseover="SetStyle('voprosyLayer27', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer27', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer27_Container">
                           <div id="wb_voprosyText32">
                              <span id="wb_uid36">По делу вынесено решение</span></div>
                           <div id="wb_voprosyRadioButton25">
                              <input type="radio" id="voprosyRadioButton25" name="3. На какой стадии Вы находитесь?" value="Подряд"><label for="voprosyRadioButton25"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer28" onmouseover="SetStyle('voprosyLayer28', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer28', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer28_Container">
                           <div id="wb_voprosyText33">
                              <span id="wb_uid37">Дело рассматривается в суде</span></div>
                           <div id="wb_voprosyRadioButton26">
                              <input type="radio" id="voprosyRadioButton26" name="3. На какой стадии Вы находитесь?" value="Аренда"><label for="voprosyRadioButton26"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer29" onmouseover="SetStyle('voprosyLayer29', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer29', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer29_Container">
                           <div id="wb_voprosyText34">
                              <span id="wb_uid38">Досудебная</span></div>
                           <div id="wb_voprosyRadioButton27">
                              <input type="radio" id="voprosyRadioButton27" name="3. На какой стадии Вы находитесь?" value="Купли-продажа"><label for="voprosyRadioButton27"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer30" onmouseover="SetStyle('voprosyLayer30', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer30', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer30_Container">
                           <div id="wb_voprosyText35">
                              <span id="wb_uid39">Не знаю</span></div>
                           <div id="wb_voprosyRadioButton28">
                              <input type="radio" id="voprosyRadioButton28" name="3. На какой стадии Вы находитесь?" value="Не знаю"><label for="voprosyRadioButton28"></label></div>
                        </div>
                     </div></label>
               </div>
            </div>
            <div id="voprosy4_3">
               <div id="voprosy4_3_Container">
                  <div id="voprosyProgressbar9">
                     <div id="voprosyProgressbar9-label">60%</div>
                  </div>
                  <div id="wb_voprosyText36">
                     <span id="wb_uid40">4. Укажите размер требований:</span></div>
                  <label><div id="voprosyLayer31" onmouseover="SetStyle('voprosyLayer31', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer31', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer31_Container">
                           <div id="wb_voprosyText37">
                              <span id="wb_uid41">Свыше 10 млн. руб.</span></div>
                           <div id="wb_voprosyRadioButton29">
                              <input type="radio" id="voprosyRadioButton29" name="3. Укажите размер требований:" value="Свыше 10 млн. руб."><label for="voprosyRadioButton29"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer32" onmouseover="SetStyle('voprosyLayer32', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer32', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer32_Container">
                           <div id="wb_voprosyText38">
                              <span id="wb_uid42">От 1 до 10 млн. руб.</span></div>
                           <div id="wb_voprosyRadioButton30">
                              <input type="radio" id="voprosyRadioButton30" name="3. Укажите размер требований:" value="От 1 до 10 млн. руб."><label for="voprosyRadioButton30"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer33" onmouseover="SetStyle('voprosyLayer33', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer33', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer33_Container">
                           <div id="wb_voprosyText39">
                              <span id="wb_uid43">До 1 млн. руб.</span></div>
                           <div id="wb_voprosyRadioButton31">
                              <input type="radio" id="voprosyRadioButton31" name="3. Укажите размер требований:" value="До 1 млн. руб."><label for="voprosyRadioButton31"></label></div>
                        </div>
                     </div></label>
               </div>
            </div>
            <div id="voprosy5_3">
               <div id="voprosy5_3_Container">
                  <div id="voprosyProgressbar10">
                     <div id="voprosyProgressbar10-label">80%</div>
                  </div>
                  <div id="wb_voprosyText40">
                     <span id="wb_uid44">5. Укажите в каком регионе находится Ваша компания:</span></div>
                  <label><div id="voprosyLayer34" onmouseover="SetStyle('voprosyLayer34', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer34', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer34_Container">
                           <div id="wb_voprosyText41">
                              <span id="wb_uid45">Другой субъект</span></div>
                           <div id="wb_voprosyRadioButton32">
                              <input type="radio" id="voprosyRadioButton32" name="5. Укажите в каком регионе находится Ваша компания:" value="Другой субъект"><label for="voprosyRadioButton32"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer35" onmouseover="SetStyle('voprosyLayer35', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer35', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer35_Container">
                           <div id="wb_voprosyText42">
                              <span id="wb_uid46">Московская область</span></div>
                           <div id="wb_voprosyRadioButton33">
                              <input type="radio" id="voprosyRadioButton33" name="5. Укажите в каком регионе находится Ваша компания:" value="Московская область"><label for="voprosyRadioButton33"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer36" onmouseover="SetStyle('voprosyLayer36', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer36', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer36_Container">
                           <div id="wb_voprosyText43">
                              <span id="wb_uid47">Москва</span></div>
                           <div id="wb_voprosyRadioButton34">
                              <input type="radio" id="voprosyRadioButton34" name="5. Укажите в каком регионе находится Ваша компания:" value="Москва"><label for="voprosyRadioButton34"></label></div>
                        </div>
                     </div></label>
               </div>
            </div>
            <div id="voprosy2_4">
               <div id="voprosy2_4_Container">
                  <div id="voprosyProgressbar11">
                     <div id="voprosyProgressbar11-label">34%</div>
                  </div>
                  <div id="wb_voprosyText44">
                     <span id="wb_uid48">2. Какой документ Вас интересует?</span></div>
                  <label><div id="voprosyLayer37" onmouseover="SetStyle('voprosyLayer37', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer37', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer37_Container">
                           <div id="wb_voprosyText45">
                              <span id="wb_uid49">Правовое заключение</span></div>
                           <div id="wb_voprosyRadioButton35">
                              <input type="radio" id="voprosyRadioButton35" name="2. Какой документ Вас интересует?" value="Правовое заключение"><label for="voprosyRadioButton35"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer38" onmouseover="SetStyle('voprosyLayer38', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer38', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer38_Container">
                           <div id="wb_voprosyText46">
                              <span id="wb_uid50">Жалоба</span></div>
                           <div id="wb_voprosyRadioButton36">
                              <input type="radio" id="voprosyRadioButton36" name="2. Какой документ Вас интересует?" value="Жалоба"><label for="voprosyRadioButton36"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer39" onmouseover="SetStyle('voprosyLayer39', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer39', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer39_Container">
                           <div id="wb_voprosyText47">
                              <span id="wb_uid51">Претензия</span></div>
                           <div id="wb_voprosyRadioButton37">
                              <input type="radio" id="voprosyRadioButton37" name="2. Какой документ Вас интересует?" value="Претензия"><label for="voprosyRadioButton37"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer40" onmouseover="SetStyle('voprosyLayer40', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer40', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer40_Container">
                           <div id="wb_voprosyText48">
                              <span id="wb_uid52">Заявление</span></div>
                           <div id="wb_voprosyRadioButton38">
                              <input type="radio" id="voprosyRadioButton38" name="2. Какой документ Вас интересует?" value="Заявление"><label for="voprosyRadioButton38"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer41" onmouseover="SetStyle('voprosyLayer41', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer41', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer41_Container">
                           <div id="wb_voprosyText49">
                              <span id="wb_uid53">Другое</span></div>
                           <div id="wb_voprosyRadioButton39">
                              <input type="radio" id="voprosyRadioButton39" name="2. Какой документ Вас интересует?" value="Другое"><label for="voprosyRadioButton39"></label></div>
                        </div>
                     </div></label>
               </div>
            </div>
            <div id="voprosy3_4">
               <div id="voprosy3_4_Container">
                  <div id="voprosyProgressbar12">
                     <div id="voprosyProgressbar12-label">67%</div>
                  </div>
                  <div id="wb_voprosyText50">
                     <span id="wb_uid54">3. Как срочно вам нужен документ?</span></div>
                  <label><div id="voprosyLayer42" onmouseover="SetStyle('voprosyLayer42', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer42', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer42_Container">
                           <div id="wb_voprosyText51">
                              <span id="wb_uid55">Непринципиально</span></div>
                           <div id="wb_voprosyRadioButton40">
                              <input type="radio" id="voprosyRadioButton40" name="3. Как срочно вам нужен документ?" value="Непринципиально"><label for="voprosyRadioButton40"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer43" onmouseover="SetStyle('voprosyLayer43', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer43', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer43_Container">
                           <div id="wb_voprosyText52">
                              <span id="wb_uid56">От 2 до 4 дней</span></div>
                           <div id="wb_voprosyRadioButton41">
                              <input type="radio" id="voprosyRadioButton41" name="3. Как срочно вам нужен документ?" value="От 2 до 4 дней"><label for="voprosyRadioButton41"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer44" onmouseover="SetStyle('voprosyLayer44', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer44', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer44_Container">
                           <div id="wb_voprosyText53">
                              <span id="wb_uid57">От 1 до 2 дней</span></div>
                           <div id="wb_voprosyRadioButton42">
                              <input type="radio" id="voprosyRadioButton42" name="3. Как срочно вам нужен документ?" value="От 1 до 2 дней"><label for="voprosyRadioButton42"></label></div>
                        </div>
                     </div></label>
               </div>
            </div>
            <div id="voprosy2_5">
               <div id="voprosy2_5_Container">
                  <div id="voprosyProgressbar13">
                     <div id="voprosyProgressbar13-label">67%</div>
                  </div>
                  <div id="wb_voprosyText54">
                     <span id="wb_uid58">2. Какое направление Вас интересует?</span></div>
                  <label><div id="voprosyLayer45" onmouseover="SetStyle('voprosyLayer45', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer45', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer45_Container">
                           <div id="wb_voprosyText55">
                              <span id="wb_uid59">Другое</span></div>
                           <div id="wb_voprosyRadioButton43">
                              <input type="radio" id="voprosyRadioButton43" name="2. Какое направление Вас интересует?" value="Другое"><label for="voprosyRadioButton43"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer46" onmouseover="SetStyle('voprosyLayer46', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer46', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer46_Container">
                           <div id="wb_voprosyText56">
                              <span id="wb_uid60">Уголовное право</span></div>
                           <div id="wb_voprosyRadioButton44">
                              <input type="radio" id="voprosyRadioButton44" name="2. Какое направление Вас интересует?" value="Уголовное право"><label for="voprosyRadioButton44"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer47" onmouseover="SetStyle('voprosyLayer47', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer47', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer47_Container">
                           <div id="wb_voprosyText57">
                              <span id="wb_uid61">Налоги</span></div>
                           <div id="wb_voprosyRadioButton45">
                              <input type="radio" id="voprosyRadioButton45" name="2. Какое направление Вас интересует?" value="Налоги"><label for="voprosyRadioButton45"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer48" onmouseover="SetStyle('voprosyLayer48', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer48', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer48_Container">
                           <div id="wb_voprosyText58">
                              <span id="wb_uid62">Гражданское право</span></div>
                           <div id="wb_voprosyRadioButton46">
                              <input type="radio" id="voprosyRadioButton46" name="2. Какое направление Вас интересует?" value="Гражданское право"><label for="voprosyRadioButton46"></label></div>
                        </div>
                     </div></label>
               </div>
            </div>
            <div id="voprosy2_1">
               <div id="voprosy2_1_Container">
                  <div id="wb_voprosyText5">
                     <span id="wb_uid63">2. По какому направлению нужна консультация?</span></div>
                  <label><div id="voprosyLayer9" onmouseover="SetStyle('voprosyLayer9', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer9', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer9_Container">
                           <div id="wb_voprosyText9">
                              <span id="wb_uid64">Другое</span></div>
                           <div id="wb_voprosyRadioButton9">
                              <input type="radio" id="voprosyRadioButton9" name="2. По какому направлению нужна консультация?" value="Другое"><label for="voprosyRadioButton9"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer8" onmouseover="SetStyle('voprosyLayer8', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer8', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer8_Container">
                           <div id="wb_voprosyText8">
                              <span id="wb_uid65">Уголовное право</span></div>
                           <div id="wb_voprosyRadioButton8">
                              <input type="radio" id="voprosyRadioButton8" name="2. По какому направлению нужна консультация?" value="Налоги"><label for="voprosyRadioButton8"></label></div>
                        </div>
                     </div></label>
                  <label><div id="voprosyLayer7" onmouseover="SetStyle('voprosyLayer7', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer7', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer7_Container">
                           <div id="wb_voprosyText7">
                              <span id="wb_uid66">Налоги</span></div>
                           <div id="wb_voprosyRadioButton7">
                              <input type="radio" id="voprosyRadioButton7" name="2. По какому направлению нужна консультация?" value="Налоги"><label for="voprosyRadioButton7"></label></div>
                        </div>
                     </div></label>
                  <div id="voprosyProgressbar2">
                     <div id="voprosyProgressbar2-label">34%</div>
                  </div>
                  <label><div id="voprosyLayer6" onmouseover="SetStyle('voprosyLayer6', 'vibor_2');return false;" onmouseout="SetStyle('voprosyLayer6', 'vibor_1');return false;" class="vibor_1">
                        <div id="voprosyLayer6_Container">
                           <div id="wb_voprosyText6">
                              <span id="wb_uid67">Гражданское право</span></div>
                           <div id="wb_voprosyRadioButton6">
                              <input type="radio" id="voprosyRadioButton6" name="2. По какому направлению нужна консультация?" value="Гражданское право"><label for="voprosyRadioButton6"></label></div>
                        </div>
                     </div></label>
               </div>
            </div>
         </div>
      </form>
      <div id="modal_zvonok" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-body">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <div id="wb_indexText5">
                     <span id="wb_uid68">Закажите обратный звонок от нас</span></div>
                  <div id="wb_indexText6">
                     <span id="wb_uid69">и мы перезвоним Вам!</span></div>
                  <div id="wb_indexForm3">
                     <form name="indexForm1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexForm3">
                        <input type="hidden" name="formid" value="indexform3">
                        <input type="text" id="indexEditbox1" name="Телефон" value="" autocomplete="off" spellcheck="true" required placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1089;&#1074;&#1086;&#1081; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;">
                        <div id="wb_indexCheckbox3">
                           <input type="checkbox" id="indexCheckbox3" name="Политика конфидициальности" value="согласны" checked required><label for="indexCheckbox3"></label></div>
                        <input type="text" id="indexEditbox7" name="Имя" value="" autocomplete="off" spellcheck="true" required pattern="[A-Za-zАБВГДЕЖЗИЙКЛМНОПРСТУФХЦШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцшщъыьэюя \t\r\n\fа,б,в,г,д,е,ё,ж,з,и,й,к,л,м,н,о,п,р,с,т,у,ф,х,ц,ч,ш,щ,ъ,ы,ь,э,ю,я,А,Б,В,Г,Д,Е,Ё,Ж,З,И,Й,К,Л,М,Н,О,П,Р,С,Т,У,Ф,Х,Ц,Ч,Ш,Щ,Ъ,Ы,Ь,Э,Ю,Я]*$" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1089;&#1074;&#1086;&#1077; &#1080;&#1084;&#1103;">
                        <div id="indexLayer15" class="blick-button">
                           <div id="indexLayer15_Container">
                              <input type="submit" id="indexButton7" onmouseover="SetStyle('indexButton7', 'knop1_2');return false;" onmouseout="SetStyle('indexButton7', 'knop1_1');return false;" name="" value="Перезвоните мне" class="knop1_1">
                           </div>
                        </div>
                        <div id="wb_indexText76" class="Oswald_ExtraLight">
                           <span id="wb_uid70">&#1053;&#1072;&#1078;&#1080;&#1084;&#1072;&#1103; &#1085;&#1072; &#1082;&#1085;&#1086;&#1087;&#1082;&#1091; &quot;Перезвоните мне&quot;, &#1103; &#1076;&#1072;&#1102; &#1089;&#1086;&#1075;&#1083;&#1072;&#1089;&#1080;&#1077; &#1085;&#1072; &#1086;&#1073;&#1088;&#1072;&#1073;&#1086;&#1090;&#1082;&#1091; &#1087;&#1077;&#1088;&#1089;&#1086;&#1085;&#1072;&#1083;&#1100;&#1085;&#1099;&#1093; &#1076;&#1072;&#1085;&#1085;&#1099;&#1093; &#1080; &#1089;&#1086;&#1075;&#1083;&#1072;&#1096;&#1072;&#1102;&#1089;&#1100; c &#1091;&#1089;&#1083;&#1086;&#1074;&#1080;&#1103;&#1084;&#1080; <a href="politika.pdf" class="phone" target="_blank">&#1087;&#1086;&#1083;&#1080;&#1090;&#1080;&#1082;&#1080; &#1082;&#1086;&#1085;&#1092;&#1080;&#1076;&#1077;&#1085;&#1094;&#1080;&#1072;&#1083;&#1100;&#1085;&#1086;&#1089;&#1090;&#1080;</a></span></div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <script src="js/jquery.maskedinput-1.3.min.js"></script>
   </body>
</html>