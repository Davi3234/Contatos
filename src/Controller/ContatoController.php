<?php
namespace Src\Controller;

use Exception;
use Src\Common\Response;
use Src\Repository\ContatoRepository;
use Src\Service\ContatoService;

class ContatoController{

    private ContatoRepository $contatoRepository;
    private ContatoService $contatoService;

    public function __construct(){
        $this->contatoRepository = new ContatoRepository();
        $this->contatoService = new ContatoService($this->contatoRepository);
    }

    /**
     * Insere um registro na tabela de contato
     * @param array $args
     * @return void
     */
    public function insereContato(array $args): void{
        try {
            $this->contatoService->insereContato($args);
            echo (new Response("Inserido com sucesso",200))->outputMessage();
        } catch (Exception $e) {
            
            echo (new Response($e->getMessage(),500))->outputMessage();
        }
    }

    /**
     * Altera um registro da tabela de contatos
     * @param array $args
     * @return void
     */
    public function alteraContato(array $args){
        try {
            $this->contatoService->updateContato($args);
            echo (new Response("Alterado com sucesso",200))->outputMessage();
        } catch (Exception $e) {
            
            echo (new Response($e->getMessage(),500))->outputMessage();
        }
    }

    /**
     * Remove uma contato da tabela de contatos
     * @param array $args
     * @return void
     */
    public function removeContato(array $args){
        try{
            $this->contatoService->removeContato($args);
            echo (new Response("Removido com sucesso",200))->outputMessage();
        }catch (Exception $e){
            echo (new Response($e->getMessage(), 500))->outputMessage();
        }
    }
    public function listAll($args){
        try{
            $contatos = $this->contatoService->listAll($args);
            echo json_encode(['contatos' => $contatos]);
        }catch (Exception $e){
            echo (new Response($e->getMessage(), 500))->outputMessage();
        }
    }

     /**
     * Chama a view de consulta
     * @return void
     */
    public function viewConsulta(){
        $breadCrumbs = [ALL_PATHS['home'], ALL_PATHS['consultaContato']];
        require_once 'src/View/Contato/consulta.php';
    }

    /**
     * Chama a view de cadastro
     * @return void
     */
    public function viewCadastro(){
        $breadCrumbs = [ALL_PATHS['home'], ALL_PATHS['consultaContato'], ALL_PATHS['cadastroContato']];

        require_once 'src/View/Contato/cadastro.php';
    }

    /**
     * Chama a view de edição
     * @param array $args
     * @return void
     */
    public function viewEdicao($args){
        $breadCrumbs = [ALL_PATHS['home'], ALL_PATHS['consultaContato'], ALL_PATHS['edicaoContato']];

        $contato = $this->contatoService->listOne($args);

        require_once 'src/View/Contato/edicao.php';
    }
}