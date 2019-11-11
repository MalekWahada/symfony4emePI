<?php
/**
 * Created by PhpStorm.
 * User: jassa
 * Date: 28/11/2018
 * Time: 2:34
 */

namespace LivreBundle;
use Endroid\QrCode\QrCode;
require "vendor/autoload.php";
use Endroid\QrCode\Bundle\QrCodeBundle\EndroidQrCodeBundle;


$qrCode = new QrCode('Life is too short to be generating QR codes');

header('Content-Type: '.$qrCode->getContentType());
echo $qrCode->writeString();