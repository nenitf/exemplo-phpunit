<?php

use App\Models\Quadrado;

class QuadradoTest extends PHPUnit\Framework\TestCase{
    /**
     * @dataProvider collectionAreas
     */
    public function testShouldCalculateTheArea(int $lado1, int $lado2, int $expectedArea)
    {
        $quadrado = new Quadrado($lado1, $lado2);
        $area = $quadrado->getArea();
        $this->assertEquals($expectedArea, $area);
    }

    public function collectionAreas()
    {
        return [
            [ 3, 2, 6 ],
            [ 4, 5, 20 ],
            [ 3, 4, 12 ]
        ];
    }
}
