<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Webmozart\Assert\Assert;

class StringsQuery extends TypedQuery
{
    use TypedQueryTrait;

    /**
     * @param int|string $hydrationMode
     * @return string[]
     */
    public function getResult($hydrationMode = self::HYDRATE_ARRAY)
    {
        Assert::same($hydrationMode, self::HYDRATE_ARRAY);
        $result =  parent::getResult($hydrationMode);
        Assert::isArray($result);
        Assert::allString($result);

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
     * @return string[]
     */
    public function getStringsResult()
    {
        return $this->getResult();
    }
}
