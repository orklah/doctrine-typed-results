<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Webmozart\Assert\Assert;

class FloatsQuery extends TypedQuery
{
    use TypedQueryTrait;

    /**
     * @param int|string $hydrationMode
     * @return float[]
     */
    public function getResult($hydrationMode = self::HYDRATE_ARRAY)
    {
        Assert::same($hydrationMode, self::HYDRATE_ARRAY);
        $result =  parent::getResult($hydrationMode);
        Assert::isArray($result);
        Assert::allNumeric($result);

        return array_map('\floatval', $result);// The cast is needed because Doctrine may return numeric values
    }

    /**
     * @internal
     */
    public function getSingleScalarResult()
    {
        die('todo');
    }

    /**
     * @return float[]
     */
    public function getFloatsResult()
    {
        return $this->getResult();
    }
}
