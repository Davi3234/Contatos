<?php
namespace Src\Common;
class Response{
    private $mensagem;
    private $status;

    public function __construct(string $mensagem, string $status){
        $this->mensagem = $mensagem;
        $this->status = $status;
    }
    
    public function outputMessage():string{
        http_response_code($this->status);
        return json_encode([
            'status' => $this->status,
            'message' => $this->mensagem
        ]);
    }
}