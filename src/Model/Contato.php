<?php

namespace Src\Model;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class Contato
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    private int $id;
    
    public function __construct(
        #[Column]
        private string $tipo,
        #[Column]
        private string $descricao,
        #[ManyToOne(targetEntity: Pessoa::class)]
        #[JoinColumn(name: 'id_pessoa', referencedColumnName: 'id')]
        private Pessoa $pessoa
    ) {}

    public function toArray(){
        return [
            'id' => $this->id,
            'tipo' => $this->getDsTipo(),
            'descricao' => $this->descricao,
            'pessoa' => $this->pessoa->getNome()
        ];
    }

    /**
     * Retorna o Id do Contato
     * @return int
     */
    public function getId(): int{
        return $this->id;
    }

    /**
     * Retorna o Tipo do Contato
     * @return string
     */
    public function getTipo(): string{
        return $this->tipo;
    }

    public function getDsTipo(): string{
        $dsTipos = [
            'TE' => 'Telefone',
            'EM' => 'Email'
        ];
        return $dsTipos[$this->tipo];
    }

    /**
     * Retorna a Descrição do Contato
     * @return string
     */
    public function getDescricao(): string{
        return $this->descricao;
    }

    /**
     * Retorna a pessoa
     * @return Pessoa
     */
    public function getPessoa(): Pessoa{
        return $this->pessoa;
    }

    /**
     * Seta o tipo no objeto
     * @param string $tipo
     * @return void
     */
    public function setTipo(string $tipo): void{
        $this->tipo = $tipo;
    }
    
    /**
     * Seta o descricao no objeto
     * @param string $descricao
     * @return void
     */
    public function setDescricao(string $descricao): void{
        $this->descricao = $descricao;
    }
    
    /**
     * Seta o a pessoa no objeto
     * @param Pessoa $pessoa
     * @return void
     */
    public function setPessoa(Pessoa $pessoa): void{
        $this->pessoa = $pessoa;
    }
}
