<?php

declare(strict_types=1);

namespace zonuexe;

use function array_fill;
use function implode;

/**
 * @Revs(10)
 * @Iterations(1)
 */
class ConcatBench
{
    /**
     * @ParamProviders({"provideLength", "provideString"})
     */
    public function benchArrayFillImplode(array $params): void
    {
        ['length' => $len, 'string' => $str] = $params;
        $s = implode(array_fill(0, $len, $str));
    }

    /**
     * @ParamProviders({"provideLength", "provideString"})
     */
    public function benchArrayPushImplode(array $params): void
    {
        ['length' => $len, 'string' => $str] = $params;
        $a = [];
        for ($i = 0; $i < $len; $i++) {
            $a[] = $str;
        }

        $s = implode($a);
    }

    /**
     * @ParamProviders({"provideLength", "provideString"})
     */
    public function benchAssignConcat(array $params): void
    {
        ['length' => $len, 'string' => $str] = $params;
        $s = '';
        for ($i = 0; $i < $len; $i++) {
            $s = $s . $str;
        }
    }

    /**
     * @ParamProviders({"provideLength", "provideString"})
     */
    public function benchAssignInterpolation(array $params): void
    {
        ['length' => $len, 'string' => $str] = $params;
        $s = '';
        for ($i = 0; $i < $len; $i++) {
            $s = "{$s}{$str}";
        }
    }

    /**
     * @ParamProviders({"provideLength", "provideString"})
     */
    public function benchAssignOp(array $params): void
    {
        ['length' => $len, 'string' => $str] = $params;
        $s = '';
        for ($i = 0; $i < $len; $i++) {
            $s .= $str;
        }
    }

    public function provideLength()
    {
        //yield 'array=0' => ['length' => 0];
        //yield 'array=1000' => ['length' => 1000];
        yield 'array=10000' => ['length' => 10000];
        //yield 'array=100000' => ['length' => 100000];
    }

    public function provideString()
    {
        yield 'string=0' => ['string' => ''];
        //yield 'string=1' => ['string' => str_repeat('a', 1)];
        yield 'string=100' => ['string' => str_repeat('a', 100)];
    }
}
