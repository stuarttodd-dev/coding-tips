<?php

declare(strict_types=1);

namespace HalfShellStudios\CodingTips\DesignPatterns\Structural\Decorator\AlternativeVersion;

class PizzaMaker
{
    /** @var array|float[]  */
    private array $crustPrices = [
        'Thin' => 3.49,
        'NewYorkStyle' => 4.49,
        'Thick' => 5.99,
    ];

    /** @var array|float[]  */
    private array $toppingPrices = [
        'Ham' => 1.29,
        'Mushrooms' => 0.99,
        'Pepperoni' => 1.49,
        'Pineapple' => 2.99,
        'Sweetcorn' => 0.49,
    ];

    /**
     * @param array<string> $toppings
     * @return array<string, float|array<string|float>>
     */
    public function makePizza(string $crust, array $toppings): array
    {
        $price = $this->crustPrices[$crust] ?? 0.00;

        $toppingsList = [];
        foreach ($toppings as $topping) {
            $price += $this->toppingPrices[$topping] ?? 0.00;
            $toppingsList[] = $topping;
        }

        return [
            'price' => round($price, 2),
            'toppings' => $toppingsList,
        ];
    }
}
