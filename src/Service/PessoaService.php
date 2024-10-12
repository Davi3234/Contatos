<?php
namespace Src\Service;

use Exception;
use Src\Model\Pessoa;
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
            $pessoa = new Pessoa(
                $args['nome'],
                $args['cpf']
            );

            $this->validaDados($pessoa);

            $this->pessoaRepository->update($pessoa);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
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
            throw new Exception(implode("\n", $this->erros));
        }
    }

    public function validaCpf(string $cpf): bool{
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