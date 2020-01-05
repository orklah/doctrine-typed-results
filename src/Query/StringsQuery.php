<?php

declare(strict_types=1);

namespace DoctrineTypedResults\Query;

use Assert\Assertion;
use Assert\AssertionFailedException;

class StringsQuery extends TypedQuery
{
    use TypedQueryTrait;

    /**
     * @param int|string $hydrationMode
     * @return string[]
     * @throws AssertionFailedException
     */
    public function getResult($hydrationMode = self::HYDRATE_ARRAY)
    {
        Assertion::true($hydrationMode === self::HYDRATE_ARRAY, 'Expected ' . self::HYDRATE_ARRAY . ' got "' . $hydrationMode . '"');
        $result =  parent::getResult($hydrationMode);
        Assertion::allIntegerish($result, 'Expected a list of String');

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
     * @throws AssertionFailedException
     */
    public function getStringsResult()
    {
        return $this->getResult();
    }
}
