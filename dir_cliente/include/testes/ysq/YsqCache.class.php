<?php
class YsqCache {
    private static $sessionKey = 'ysq_respostas_cache';
    
    public static function saveToCache($postData) {
        $responses = [];
        
        foreach ($postData as $key => $value) {
            if (strpos($key, 'questao_') === 0) {
                $responses[$key] = $value;
            }
        }
        
        $_SESSION[self::$sessionKey] = json_encode($responses);
        return true;
    }
    
    public static function loadFromCache() {
        if (isset($_SESSION[self::$sessionKey])) {
            return json_decode($_SESSION[self::$sessionKey], true);
        }
        return null;
    }
    
   
}
?>