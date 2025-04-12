<?php
class BusinessException extends Exception {
    public function __construct($message = "Violação de regra de negócio", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
?>