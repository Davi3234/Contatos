<?php
namespace Src\Service;

use Exception;
use Src\Model\Pessoa;
use Src\Repository\ContatoRepository;
use Src\Repository\PessoaRepository;

class PessoaService{

    private PessoaRepository $pessoaRepository;
    private array $erros;

    public function __construct(PessoaRepository $pessoaRepository){
        $this->pessoaRepository = $pessoaRepository;
        $this->erros = [];
    }

    /**
     * Função responsável por inserir a pessoa
     * @param array $args
     * @throws Exception
     * @return void
     */
    public function inserePessoa(array $args): void{
        try {
            $pessoa = new Pessoa(
                $args['nome'],
                $args['cpf']
            );

            $this->validaDados($pessoa);

            $this->pessoaRepository->insert($pessoa);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Função responsável por editar a pessoa
     * @param array $args
     * @throws Exception
     * @return void
     */
    public function updatePessoa(array $args): void{
        try {
            $pessoa = $this->pessoaRepository->searchById($args['id']);
            
            $pessoa->setNome($args['nome']);
            $pessoa->setCpf($args['cpf']);

            $this->validaDados($pessoa);

            $this->pessoaRepository->update($pessoa);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Função responsável por remover uma pessoa
     * @param array $args
     * @throws Exception
     * @return void
     */
    public function removePessoa(array $args): void{
        try {
            $pessoa = $this->pessoaRepository->searchById($args['id']);

            $contatoRepository = new ContatoRepository();

            $contatoRepository->buildQuery(['pessoa' => $pessoa]);
            $contatos = $contatoRepository->searchAllByCondicao();

            if(is_array($contatos) && count($contatos) > 0){
                foreach($contatos as $contato){
                    $contatoRepository->delete($contato);
                }
            }

            $this->pessoaRepository->delete($pessoa);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Função responsável por editar a pessoa
     * @param array $args
     * @throws Exception
     * @return Pessoa[]
     */
    public function listAll(array $args){
        try {
            $this->pessoaRepository->buildQuery($args);
            return $this->modelToArray($this->pessoaRepository->searchAllByCondicao());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Função responsável por editar a pessoa
     * @param array $args
     * @throws Exception
     * @return Pessoa
     */
    public function listOne(array $args){
        try {
            return $this->pessoaRepository->searchById($args['id']);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Converte uma lista de pessoas para um array indexado
     * @param Pessoa[] $pessoas
     * @return array
     */
    private function arrayModelToArray($pessoas){
        return array_map(function($pessoa){
            return $pessoa->toArray();
        }, $pessoas);
    }
    private function modelToArray($pessoas){
        return array_map(function($pessoa){
            return $pessoa->toArray();
        }, $pessoas);
    }

    public function validaDados(Pessoa $pessoa){
        if($pessoa->getNome() == ""){
            $this->erros[] = "Nome é de preenchimento obrigatório.";
        }
        if($pessoa->getCpf() == ""){
            $this->erros[] = "CPF é de preenchimento obrigatório.";
        }
        if($pessoa->getCpf() != "" && !$this->validaCpf($pessoa->getCpf())){
            $this->erros[] = "CPF é inválido.";
        }
        if(count($this->erros) > 0){
            throw new Exception(implode("<br>", $this->erros));
        }
    }

    public function validaCpf(string $cpf): bool{
        $cpf = preg_replace('/[\.\-]/i','', $cpf);
        if(strlen($cpf) != 11){
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

}