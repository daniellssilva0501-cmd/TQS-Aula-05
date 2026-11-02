<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

// Vais criar a classe ValidadorPasse em src/ValidadorPasse.php.
// Depois de a criares, descomenta a linha seguinte:
require_once __DIR__ . '/../src/ValidadorPasse.php';

/**
 * Exercicio P5.3  ·  Ciclo TDD  ·  Validador de palavra-passe
 *
 * Aqui vais trabalhar ao contrario do habitual: escreves o TESTE PRIMEIRO,
 * ve-lo falhar (vermelho), depois escreves o codigo para ele passar (verde).
 *
 * Uma palavra-passe e valida quando cumpre, ao mesmo tempo:
 *   1. tem no minimo 8 caracteres;
 *   2. tem pelo menos uma letra maiuscula;
 *   3. tem pelo menos um digito.
 *
 * Como fazer, um requisito de cada vez:
 *   a) Escreve UM teste para o requisito 1 (ex.: 'Ab1' deve ser invalida).
 *   b) Corre o php phpunit e confirma que FALHA (ainda nao ha codigo).
 *   c) Cria a classe ValidadorPasse com o metodo valida() e faz o teste passar.
 *   d) So depois avanca para o requisito 2, e por fim o requisito 3.
 *
 * Confirma sempre a conta a mao antes de escrever o resultado esperado.
 */
class ValidadorPasseTest extends TestCase
{
    // TODO P5.3: comeca aqui pelo requisito 1 (minimo de 8 caracteres).
    //
    public function testPasseCurtaEhInvalida(): void
    {
        // Arrange: criar o validador
        $validador = new ValidadorPasse();

        // Act: validar uma passe com só 3 caracteres
        $resultado = $validador->valida('Ab1');

        // Assert: tem de ser inválida
        $this->assertFalse($resultado);
    }
    public function testPasseValidaEhAceite(): void
    {
        $validador = new ValidadorPasse();

        $resultado = $validador->valida('Abcdefg1');

        $this->assertTrue($resultado);
    }

    public function testPasseSemMaiusculaEhInvalida(): void
    {
        $validador = new ValidadorPasse();

        // 'abcdefg1' tem 8 caracteres e um dígito, mas NENHUMA maiúscula
        $resultado = $validador->valida('abcdefg1');

        $this->assertFalse($resultado);
    }

    public function testPasseSemDigitoEhInvalida(): void
    {
        $validador = new ValidadorPasse();

        // 'Abcdefgh' tem 8 caracteres e maiúscula, mas NENHUM dígito
        $resultado = $validador->valida('Abcdefgh');

        $this->assertFalse($resultado);
    }



}
