<?php
class ValidationException extends Exception {
    private $errors;

    public function __construct(array $errors, $message = "Erros de validação", $code = 0, Throwable $previous = null) {
        $this->errors = $errors;
        parent::__construct($message, $code, $previous);
    }

    public function getErrors() {
        return $this->errors;
    }
}
?>