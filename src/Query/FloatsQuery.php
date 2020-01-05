<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Assert\Assertion;
use Assert\AssertionFailedException;

class FloatsQuery extends TypedQuery
{
    use TypedQueryTrait;

    /**
     * @param int|string $hydrationMode
     * @return float[]
     * @throws AssertionFailedException
     */
    public function getResult($hydrationMode = self::HYDRATE_ARRAY)
    {
        Assertion::true($hydrationMode === self::HYDRATE_ARRAY, 'Expected ' . self::HYDRATE_ARRAY . ' got "' . $hydrationMode . '"');
        $result =  parent::getResult($hydrationMode);
        Assertion::allNumeric($result, 'Expected a list of Float');

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
     * @throws AssertionFailedException
     */
    public function getFloatsResult()
    {
        return $this->getResult();
    }
}
