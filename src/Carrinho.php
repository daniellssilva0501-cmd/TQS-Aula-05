<?php

declare(strict_types=1);

/**
 * Carrinho de compras simples.
 *
 * Guarda artigos (nome, preco, quantidade) e calcula o total a pagar.
 * E a classe usada nos exercicios P5.1 (primeiros testes) e P5.2 (excecoes).
 */
class Carrinho
{
    /** @var array<int, array{nome: string, preco: int, qt: int}> */
    private array $itens = [];

    /**
     * Adiciona um artigo ao carrinho.
     *
     * Regras:
     *  - o preco tem de ser maior que zero;
     *  - a quantidade tem de estar entre 1 e 20 (inclusive).
     *
     * @throws InvalidArgumentException se o preco ou a quantidade forem invalidos.
     */
    public function adicionar(string $nome, int $preco, int $qt): void
    {
        if ($preco <= 0) {
            throw new InvalidArgumentException('O preco tem de ser maior que zero.');
        }
        if ($qt < 1 || $qt > 20) {
            throw new InvalidArgumentException('A quantidade tem de estar entre 1 e 20.');
        }

        $this->itens[] = ['nome' => $nome, 'preco' => $preco, 'qt' => $qt];
    }

    /**
     * Devolve o total a pagar: para cada artigo, preco vezes quantidade.
     */
    public function total(): int
    {
        $total = 0;
        foreach ($this->itens as $item) {
            $total += $item['preco'] * $item['qt'];
        }
        return $total;
    }

    /**
     * Devolve o numero de artigos (linhas) no carrinho.
     */
    public function numeroDeArtigos(): int
    {
        return count($this->itens);
    }

    /**
     * Indica se o carrinho esta vazio.
     */
    public function vazio(): bool
    {
        return $this->itens === [];
    }

    /**
     * Devolve o desconto de estudante para a idade indicada.
     *
     * Regra: 10% (0.10) para idades entre 18 e 25 (inclusive); 0% fora desse intervalo.
     */
    public function descontoEstudante(int $idade): float
    {
        if ($idade >= 18 && $idade <= 25) {
            return 0.10;
        }
        return 0.0;
    }
}
