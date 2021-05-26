<?PHP

    function prepareSend($str) {
        return rawurlencode(base64_encode(gzcompress(encrypt(serialize($str)))));
    }

    function prepareReceive($str) {
        return unserialize(decrypt(gzuncompress(base64_decode(rawurldecode($str)))));
    }

    function encrypt($str) {
        $token = '1EDD2D2F-2BFE-4B23-948F-15AA04BBC102';
        if(!$token){
            $key = 'r4h4514';
        }else{
            $key = substr($token,0,1).substr($token,10,11).substr($token,20,21);
        }
        $str = cryptare($str, 1, $key);
        return $str;
    }

    function decrypt($str) {
        $token = '1EDD2D2F-2BFE-4B23-948F-15AA04BBC102';
        if(!$token){
            $key = 'r4h4514';
        }else{
            $key = substr($token,0,1).substr($token,10,11).substr($token,20,21);
        }
        $str = cryptare($str, 0, $key);
        return $str;
    }

    function cryptare($text, $crypt, $secret_key, $alg='AES-256-CBC') {
        $output = false;

        $secret_iv = '45FCB854-84D6-4E6C-961F-A51D4AD08DB7';
        $key = hash('sha256', $secret_key,true);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($crypt) {
            $output = openssl_encrypt($text, $alg, $key, 0, $iv);
            $output = base64_encode($output);
        } 
        else{
            $output = openssl_decrypt(base64_decode($text), $alg, $key, 0, $iv);
        }
        return $output;
    }
    
?>