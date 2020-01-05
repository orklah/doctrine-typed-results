<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Assert\Assertion;
use Assert\AssertionFailedException;

class BoolsQuery extends TypedQuery
{
    use TypedQueryTrait;

    /**
     * @param int|string $hydrationMode
     * @return bool[]
     * @throws AssertionFailedException
     */
    public function getResult($hydrationMode = self::HYDRATE_ARRAY)
    {
        Assertion::true($hydrationMode === self::HYDRATE_ARRAY, 'Expected ' . self::HYDRATE_ARRAY . ' got "' . $hydrationMode . '"');
        $result =  parent::getResult($hydrationMode);
        Assertion::allNumeric($result, 'Expected a list of Bool');

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
     * @throws AssertionFailedException
     */
    public function getBoolsResult()
    {
        return $this->getResult();
    }
}
