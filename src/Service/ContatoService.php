<?php
namespace Src\Service;

use Exception;
use Src\Model\Contato;
use Src\Repository\ContatoRepository;
use Src\Repository\PessoaRepository;

class ContatoService{

    private ContatoRepository $contatoRepository;
    private array $erros;

    public function __construct(ContatoRepository $contatoRepository){
        $this->contatoRepository = $contatoRepository;
        $this->erros = [];
    }

    /**
     * Função responsável por inserir a contato
     * @param array $args
     * @throws Exception
     * @return void
     */
    public function insereContato(array $args): void{
        try {
            $contato = new Contato(
                $args['tipo'],
                $args['descricao'],
                (new PessoaService(new PessoaRepository()))->listOne(['id' => $args['id_pessoa']])
            );

            $this->validaDados($contato);

            $this->contatoRepository->insert($contato);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Função responsável por editar a contato
     * @param array $args
     * @throws Exception
     * @return void
     */
    public function updateContato(array $args): void{
        try {
            $contato = $this->contatoRepository->searchById($args['id']);

            $contato->setTipo($args['tipo']);
            $contato->setDescricao($args['descricao']);
            $contato->setPessoa((new PessoaService(new PessoaRepository()))->listOne(['id' => $args['id_pessoa']]));

            $this->validaDados($contato);

            $this->contatoRepository->update($contato);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Função responsável por remover uma contato
     * @param array $args
     * @throws Exception
     * @return void
     */
    public function removeContato(array $args): void{
        try {
            $contato = $this->contatoRepository->searchById($args['id']);

            $this->contatoRepository->delete($contato);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Função responsável por editar a contato
     * @param array $args
     * @throws Exception
     * @return Contato[]
     */
    public function listAll(array $args){
        try {
            $this->contatoRepository->buildQuery($args);
            return $this->modelToArray($this->contatoRepository->searchAllByCondicao());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Função responsável por editar a contato
     * @param array $args
     * @throws Exception
     * @return Contato
     */
    public function listOne(array $args){
        try {
            return $this->contatoRepository->searchById($args['id']);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Converte uma lista de contatos para um array indexado
     * @param Contato[] $contatos
     * @return array
     */
    private function modelToArray($contatos){
      return array_map(function($contato){
        return $contato->toArray();
      }, $contatos);
    }

    public function validaDados(Contato $contato){
        if($contato->getTipo() == ""){
            $this->erros[] = "Tipo é de preenchimento obrigatório.";
        }
        if($contato->getDescricao() == ""){
            $this->erros[] = "Descrição é de preenchimento obrigatório.";
        }
        if(!is_object($contato->getPessoa())){
            $this->erros[] = "Pessoa é de preenchimento obrigatório.";
        }
        
        if(count($this->erros) > 0){
            throw new Exception(implode("<br>", $this->erros));
        }
    }
}