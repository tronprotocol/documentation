<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php
    function base58_encode($string)
    {
        $alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
        $base = strlen($alphabet);
        if (is_string($string) === false) {
            return false;
        }
        if (strlen($string) === 0) {
            return '';
        }
        $bytes = array_values(unpack('C*', $string));
        $decimal = $bytes[0];
        for ($i = 1, $l = count($bytes); $i < $l; $i++) {
            $decimal = bcmul($decimal, 256);
            $decimal = bcadd($decimal, $bytes[$i]);
        }
        $output = '';
        while ($decimal >= $base) {
            $div = bcdiv($decimal, $base, 0);
            $mod = bcmod($decimal, $base);
            $output .= $alphabet[$mod];
            $decimal = $div;
        }
        if ($decimal > 0) {
            $output .= $alphabet[$decimal];
        }
        $output = strrev($output);
        foreach ($bytes as $byte) {
            if ($byte === 0) {
                $output = $alphabet[0] . $output;
                continue;
            }
            break;
        }
        return (string) $output;
    }
    function base58_decode($base58)
    {
        $alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
        $base = strlen($alphabet);
        if (is_string($base58) === false) {
            return false;
        }
        if (strlen($base58) === 0) {
            return '';
        }
        $indexes = array_flip(str_split($alphabet));
        $chars = str_split($base58);
        foreach ($chars as $char) {
            if (isset($indexes[$char]) === false) {
                return false;
            }
        }
        $decimal = $indexes[$chars[0]];
        for ($i = 1, $l = count($chars); $i < $l; $i++) {
            $decimal = bcmul($decimal, $base);
            $decimal = bcadd($decimal, $indexes[$chars[$i]]);
        }
        $output = '';
        while ($decimal > 0) {
            $byte = bcmod($decimal, 256);
            $output = pack('C', $byte) . $output;
            $decimal = bcdiv($decimal, 256, 0);
        }
        foreach ($chars as $char) {
            if ($indexes[$char] === 0) {
                $output = "\x00" . $output;
                continue;
            }
            break;
        }
        return $output;
    }
    
    //encode address from byte[] to base58check string
    function base58check_en($address)
    {
     $hash0 = hash("sha256", $address);
     $hash1 = hash("sha256", hex2bin($hash0));
     $checksum = substr($hash1, 0, 8);
     $address = $address.hex2bin($checksum);
     $base58add = base58_encode($address);
     return $base58add;
    }

    //decode address from base58check string to byte[]
    function base58check_de($base58add)
    {
     $address = base58_decode($base58add);
     $size = strlen($address);
     if ($size != 25) {
        return false;
     }
     $checksum = substr($address, 21);
     $address = substr($address, 0, 21);     
     $hash0 = hash("sha256", $address);
     $hash1 = hash("sha256", hex2bin($hash0));
     $checksum0 = substr($hash1, 0, 8);
     $checksum1 = bin2hex($checksum);
     if (strcmp($checksum0, $checksum1)) {
        return false;
     }
     return $address;
    }

    function hexString2Base58check($hexString){
        $address = hex2bin($hexString);
        $base58add = base58check_en($address);
        return $base58add;
    }

    function base58check2HexString($base58add){
        $address = base58check_de($base58add);
        $hexString = bin2hex($address);
        return $hexString;
    }

    function hexString2Base64($hexString){
        $address = hex2bin($hexString);
        $base64 = base64_encode($address);
        return $base64;
    }

    function base642HexString($base64){
        $address = base64_decode($base64);
        $hexString = bin2hex($address);
        return $hexString;
    }

    function base58check2Base64($base58add){
        $address = base58check_de($base58add);
        $base64 = base64_encode($address);
        return $base64;
    }

    function base642Base58check($base64){
        $address = base64_decode($base64);
        $base58add = base58check_en($address);
        return $base58add;
    }

    $base64 = 'QUiA0LBVaoVtXofZAEWjebc3ggpl';
    echo "base64_0:: ".$base64;
    echo '<br>';
    echo "----Test base64 to hexString , base64 to base58check---";
    echo "<br>";
    $hexString = base642HexString($base64);
    echo "hexString_0:: ".$hexString;
    echo '<br>';
    $base58check = base642Base58check($base64);
    echo "base58check_0:: ".$base58check;
    echo '<br>';
    echo "-------------------------------------------------------";
    echo "<br>";
    echo "<br>";
    echo "--Test hexString to  base58check, hexString to base64--";
    echo "<br>";
    $base58check_1 = hexString2Base58check($hexString);
    echo "base58check_1:: ".$base58check_1;
    echo '<br>';
    $base64_1 = hexString2Base64($hexString);
    echo "base64_1:: ".$base64_1;
    echo '<br>';
    echo "-------------------------------------------------------";
    echo "<br>";
    echo "<br>";
    echo "--Test base58check to hexString, base58check to base64-";
    echo "<br>";
    $hexString_2 = base58check2HexString($base58check);
    echo "hexString_2:: ".$hexString_2;
    echo '<br>';
    $base64_2 = base58check2Base64($base58check);
    echo "base64_2:: ".$base64_2;
    echo '<br>';
    echo "-----------------------end------------------------------";     
?>  

</body>
</html>

