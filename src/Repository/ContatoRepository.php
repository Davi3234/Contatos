<?php

namespace Src\Repository;

use Src\Model\Contato;

class ContatoRepository extends Repository{
    /**
     * Retorna o nome da classe da entidade Contato
     * @return string
     */
    protected function getEntityClass(): string {
        return Contato::class;
    }
}
