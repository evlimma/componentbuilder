<?php

namespace evlimma\ComponentBuilder;

trait Helpers
{
    /**
     * Retorna os últimos $count caracteres da string.
     *
     * @param string|null $value A string de entrada.
     * @param int $count A quantidade de caracteres a retornar a partir da direita.
     * @return string|null Retorna a parte final da string ou null se a string for nula.
     */
    public function right(?string $value, int $count): ?string
    {
        return $value !== null ? substr($value, -$count) : null;
    }
}