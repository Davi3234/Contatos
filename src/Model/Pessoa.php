<?php

namespace Src\Model;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity]
class Pessoa
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    public readonly int $id;

    public function __construct(
        #[Column]
        private string $nome,
        #[Column]
        private string $cpf
    ) {}

    public function toArray(){
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cpf' => $this->cpf
        ];
    }

    /**
     * Retorna o Id da Pessoa
     * @return int
     */
    public function getId(): int{
        return $this->id;
    }
    /**
     * Retorna Nome da Pessoa
     * @return string
     */
    public function getNome(): string{
        return $this->nome;
    }
    /**
     * Retorna o CPF da Pessoa
     * @return string
     */
    public function getCpf(): string{
        return $this->cpf;
    }
    /**
     * Seta o nome no objeto
     * @param string $nome
     * @return void
     */
    public function setNome(string $nome): void{
        $this->nome = $nome;
    }
    /**
     * Seta o cpf no objeto
     * @param string $cpf
     * @return void
     */
    public function setCpf(string $cpf): void{
        $this->cpf = $cpf;
    }
}
