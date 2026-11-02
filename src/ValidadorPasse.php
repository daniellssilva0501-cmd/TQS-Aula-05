<?php

declare(strict_types=1);

/**
 * Valida palavras-passe.
 */
class ValidadorPasse
{
    public function valida(string $passe): bool
    {
        // Requisito 1: no mínimo 8 caracteres
        if (strlen($passe) < 8) {
            return false;
        }

        // Requisito 2: pelo menos uma letra maiúscula
        if (!preg_match('/[A-Z]/', $passe)) {
            return false;
        }

        // Requisito 3: pelo menos um dígito
        if (!preg_match('/[0-9]/', $passe)) {
            return false;
        }



        return true;
    }
}
