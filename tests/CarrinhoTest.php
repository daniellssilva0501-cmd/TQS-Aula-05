<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Carrinho.php';

/**
 * Testes da classe Carrinho.
 *
 * Aqui vais escrever os testes dos exercicios P5.1 e P5.2.
 * O primeiro teste ja esta feito, para servir de exemplo.
 * Segue sempre o padrao AAA (Arrange, Act, Assert) e nomes descritivos.
 */
class CarrinhoTest extends TestCase
{
    private Carrinho $carrinho;

    protected function setUp(): void
    {
        // Corre antes de cada teste: cada teste comeca com um carrinho novo.
        $this->carrinho = new Carrinho();
    }

    // ================================================================
    // P5.1  Primeiros testes  (exemplo ja feito + os teus testes)
    // ================================================================

    public function testTotalVazioEhZero(): void
    {
        // Arrange ja feito no setUp()
        $this->assertSame(0, $this->carrinho->total());      // Act + Assert
    }

    public function testTotalComUmArtigo(): void
    {
        $this->carrinho->adicionar('A', 10, 2);              // Arrange

        $resultado = $this->carrinho->total();               // Act

        $this->assertSame(20, $resultado);                   // Assert: 10 x 2 = 20
    }

    public function testTotalComDoisArtigos(): void
    {
        $this->carrinho->adicionar('A', 10, 2);              // Arrange
        $this->carrinho->adicionar('B', 5, 1);

        $resultado = $this->carrinho->total();               // Act

        $this->assertSame(25, $resultado);                   // Assert: 20 + 5 = 25
    }

    public function testTotalComTresArtigos(): void
    {
        $this->carrinho->adicionar('A', 10, 2);              // Arrange
        $this->carrinho->adicionar('B', 5, 1);
        $this->carrinho->adicionar('C', 3, 4);

        $resultado = $this->carrinho->total();               // Act

        $this->assertSame(37, $resultado);                   // Assert: 20 + 5 + 12 = 37
    }

    public function testNumeroDeArtigos_ComTresArtigos_DevolveTres(): void
    {
        $this->carrinho->adicionar('A', 10, 2);              // Arrange
        $this->carrinho->adicionar('B', 5, 1);
        $this->carrinho->adicionar('C', 3, 4);

        $resultado = $this->carrinho->numeroDeArtigos();     // Act

        $this->assertSame(3, $resultado);                    // Assert
    }

    public function testCarrinhoNovoEstaVazio(): void
    {
        $this->assertTrue($this->carrinho->vazio());         // Act + Assert
    }

    public function testCarrinhoComArtigoNaoEstaVazio(): void
    {
        $this->carrinho->adicionar('A', 10, 1);              // Arrange

        $this->assertFalse($this->carrinho->vazio());        // Act + Assert
    }

    // Desconto de estudante: 10% entre os 18 e os 25 anos (inclusive).

    public function testDescontoEstudante_ComIdade20_Devolve10PorCento(): void
    {
        $this->assertSame(0.10, $this->carrinho->descontoEstudante(20));
    }

    public function testDescontoEstudante_ComIdade30_DevolveZero(): void
    {
        $this->assertSame(0.0, $this->carrinho->descontoEstudante(30));
    }

    public function testDescontoEstudante_ComIdade17_DevolveZero(): void
    {
        $this->assertSame(0.0, $this->carrinho->descontoEstudante(17));
    }

    public function testDescontoEstudante_ComIdade18_Devolve10PorCento(): void
    {
        // valor fronteira inferior
        $this->assertSame(0.10, $this->carrinho->descontoEstudante(18));
    }

    public function testDescontoEstudante_ComIdade25_Devolve10PorCento(): void
    {
        // valor fronteira superior
        $this->assertSame(0.10, $this->carrinho->descontoEstudante(25));
    }

    public function testDescontoEstudante_ComIdade26_DevolveZero(): void
    {
        $this->assertSame(0.0, $this->carrinho->descontoEstudante(26));
    }


    // ================================================================
    // P5.2  Testar excecoes
    // ================================================================

    // Ordem: primeiro expectException, SO DEPOIS a chamada que da erro.

    public function testQtZeroLevantaErro(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->carrinho->adicionar('A', 10, 0);
    }

    public function testQtAcimaDe20LevantaErro(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->carrinho->adicionar('A', 10, 21);
    }

    public function testPrecoNegativoLevantaErro(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->carrinho->adicionar('A', -5, 1);
    }

    public function testMensagemDoErro_QtZero_FalaDaQuantidade(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('quantidade');
        $this->carrinho->adicionar('A', 10, 0);
    }

    public function testMensagemDoErro_PrecoNegativo_FalaDoPreco(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('preco');
        $this->carrinho->adicionar('A', -5, 1);
    }
}
