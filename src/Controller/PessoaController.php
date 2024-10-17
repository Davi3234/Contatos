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
     * Insere um registro na tabela de pessoa
     * @param array $args
     * @return void
     */
    public function inserePessoa(array $args): void{
        try {
            $this->pessoaService->inserePessoa($args);
            echo (new Response("Inserido com sucesso",200))->outputMessage();
        } catch (Exception $e) {
            
            echo (new Response($e->getMessage(),500))->outputMessage();
        }
    }

    /**
     * Altera um registro da tabela de pessoas
     * @param array $args
     * @return void
     */
    public function alteraPessoa(array $args){
        try {
            $this->pessoaService->updatePessoa($args);
            echo (new Response("Alterado com sucesso",200))->outputMessage();
        } catch (Exception $e) {
            
            echo (new Response($e->getMessage(),500))->outputMessage();
        }
    }

    /**
     * Remove uma pessoa da tabela de pessoas
     * @param array $args
     * @return void
     */
    public function removePessoa(array $args){
        try{
            $this->pessoaService->removePessoa($args);
            echo (new Response("Removido com sucesso",200))->outputMessage();
        }catch (Exception $e){
            echo (new Response($e->getMessage(), 500))->outputMessage();
        }
    }
    public function listAll($args){
        try{
            $pessoas = $this->pessoaService->listAll($args);
            echo json_encode(['pessoas' => $pessoas]);
        }catch (Exception $e){
            echo (new Response($e->getMessage(), 500))->outputMessage();
        }
    }

     /**
     * Chama a view de consulta
     * @return void
     */
    public function viewConsulta(){
        $breadCrumbs = [ALL_PATHS['home'], ALL_PATHS['consultaPessoa']];
        require_once 'src/View/Pessoa/consulta.php';
    }

    /**
     * Chama a view de cadastro
     * @return void
     */
    public function viewCadastro(){
        $breadCrumbs = [ALL_PATHS['home'], ALL_PATHS['consultaPessoa'], ALL_PATHS['cadastroPessoa']];

        require_once 'src/View/Pessoa/cadastro.php';
    }

    /**
     * Chama a view de edição
     * @param array $args
     * @return void
     */
    public function viewEdicao($args){
        $breadCrumbs = [ALL_PATHS['home'], ALL_PATHS['consultaPessoa'], ALL_PATHS['edicaoPessoa']];

        $pessoa = $this->pessoaService->listOne($args);

        require_once 'src/View/Pessoa/edicao.php';
    }
}