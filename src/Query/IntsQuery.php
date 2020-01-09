<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Assert\Assertion;
use Assert\AssertionFailedException;

class IntsQuery extends TypedQuery
{
    use TypedQueryTrait;

    /**
     * @param int|string $hydrationMode
     * @return int[]
     * @throws AssertionFailedException
     */
    public function getResult($hydrationMode = self::HYDRATE_ARRAY)
    {
        Assertion::same($hydrationMode, self::HYDRATE_ARRAY, 'Expected ' . self::HYDRATE_ARRAY . ' got "' . $hydrationMode . '"');
        $result =  parent::getResult($hydrationMode);
        Assertion::allIntegerish($result, 'Expected a list of Int');

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
     * @throws AssertionFailedException
     */
    public function getIntsResult()
    {
        return $this->getResult();
    }
}
