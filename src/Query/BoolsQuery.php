<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Webmozart\Assert\Assert;

class BoolsQuery extends TypedQuery
{
    use TypedQueryTrait;

    /**
     * @param int|string $hydrationMode
     * @return bool[]
     */
    public function getResult($hydrationMode = self::HYDRATE_ARRAY)
    {
        Assert::same($hydrationMode, self::HYDRATE_ARRAY);
        $result =  parent::getResult($hydrationMode);
        Assert::isArray($result);
        Assert::allBoolean($result);

        return $result;
    }

    /**
     * @internal
     */
    public function getSingleScalarResult()
    {
        die('todo');
    }

    /**
     * @return bool[]
     */
    public function getBoolsResult()
    {
        return $this->getResult();
    }
}
