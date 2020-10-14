<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Webmozart\Assert\Assert;

class IntsQuery extends TypedQuery
{
    use TypedQueryTrait;

    /**
     * @param int|string $hydrationMode
     * @return int[]
     */
    public function getResult($hydrationMode = self::HYDRATE_ARRAY)
    {
        Assert::same($hydrationMode, self::HYDRATE_ARRAY);
        $result =  parent::getResult($hydrationMode);
        Assert::isArray($result);
        Assert::allIntegerish($result);

        return array_map('\intval', $result);// The cast is needed because Doctrine may return numeric values
    }

    /**
     * @internal
     */
    public function getSingleScalarResult()
    {
        die('todo');
    }

    /**
     * @return int[]
     */
    public function getIntsResult()
    {
        return $this->getResult();
    }
}
