<?php
class Erro{
    private array $tipo = [
        'required' => ' é de preenchimento obrigatório',

    ];
    private string $campo;
    private string $mensagem;
    
    public function __construct($tipo, $campo){
        $this->tipo = $tipo;
        $this->campo = $campo;
        $this->mensagem = $this->initMensagem();
    }

    public function initMensagem(){
        
    }
}