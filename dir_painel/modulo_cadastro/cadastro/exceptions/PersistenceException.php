<?php
class PersistenceException extends Exception {
    public function __construct($message = "Erro na persistência de dados", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
?>