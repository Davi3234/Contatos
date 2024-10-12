<?php
namespace Src\Controller;

use Exception;
use Src\Common\Response;
use Src\Repository\PessoaRepository;
use Src\Service\PessoaService;

class PessoaController{

    private PessoaRepository $pessoaRepository;
    private PessoaService $pessoaService;

    public function __construct(){
        $this->pessoaRepository = new PessoaRepository();
        $this->pessoaService = new PessoaService($this->pessoaRepository);
    }

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
    public function alteraPessoa(array $args, $id){

    }
    public function removePessoa(array $id){

    }
    public function getPessoa(int $id){

    }
}