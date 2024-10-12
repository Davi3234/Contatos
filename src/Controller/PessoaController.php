<?php
namespace Src\Controller;

use Exception;
use Src\Common\Response;
use Src\Repository\PessoaRepository;
use Src\Service\PessoaService;

class PessoaController{

    public function __construct(
        private $pessoaRepository = new PessoaRepository(),
        private $pessoaService = new PessoaService($pessoaRepository)
    ){}

    /**
     * Summary of inserePessoa
     * @param array $args
     * @return void
     */
    public function inserePessoa(array $args): void{
        try {
            $this->pessoaService->inserePessoa($args);
            echo (new Response("Inserido com sucesso","200"))->outputMessage();
        } catch (Exception $e) {
            echo (new Response($e->getMessage(),"500"))->outputMessage();
        }
    }
}