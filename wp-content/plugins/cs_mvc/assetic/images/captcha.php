<?php
function texto($ancho)
{
    $muestra = '';
    $cadena = "0123456789abcdefghijklmnñloqrstwxyz";
    for ($i = 0; $i < $ancho; $i++) {
        $muestra .= $cadena{rand(0, 35)};
    }
    return $muestra;
}
$_SESSION['captcha'] = texto(5);

$captchaImage = imagecreatefrompng("captcha.png");
$textColor = imagecolorallocate($captchaImage, 31, 118, 92);
$lineColor = imagecolorallocate($captchaImage, 15, 103, 103);
$imageInfo = getimagesize("captcha.png");
$linesToDraw = 10;
for ($i = 0; $i < $linesToDraw; $i++) {
    $xStart = mt_rand(0, $imageInfo[0]);
    $xEnd = mt_rand(0, $imageInfo[0]);
    imageline($captchaImage, $xStart, 0, $xEnd, $imageInfo[1], $lineColor);
}
imagettftext($captchaImage, 20, 0, 22, 30, $textColor, "../fonts/VeraSeBd.ttf", $_SESSION['captcha']);
header("Content-type: image/png");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Fri, 19 Jan 1994 05:00:00 GMT");
header("Pragma: no-cache");
imagepng($captchaImage);

?>