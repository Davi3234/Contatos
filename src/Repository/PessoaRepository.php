<?php

namespace Src\Repository;

use Src\Model\Pessoa;

class PessoaRepository extends Repository{
    /**
     * Retorna o nome da classe da entidade Pessoa
     * @return string
     */
    protected function getEntityClass(): string {
        return Pessoa::class;
    }
}
