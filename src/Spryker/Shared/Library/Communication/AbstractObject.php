<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Library\Communication;

abstract class AbstractObject implements ObjectInterface
{

    /**
     * @var array
     */
    protected $values;

    /**
     * @param array|null $values
     */
    public function __construct(array $values = null)
    {
        if ($values) {
            $this->fromArray($values);
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $values = $this->values;

        foreach ($values as $key => $value) {
            if ($value === null || is_array($value) && empty($value)) {
                unset($values[$key]);
                continue;
            }

            if (is_array($value)) {
                foreach ($value as $subKey => $subValue) {
                    if ($subValue === null || is_array($subValue) && empty($subValue)) {
                        unset($value[$subKey]);
                        continue;
                    }

                    if (is_object($subValue) && method_exists($subValue, 'toArray')) {
                        /** @var \Spryker\Shared\Library\Communication\ObjectInterface $subValue */
                        $value[$subKey] = $subValue->toArray();
                    }
                }
                if (empty($value)) {
                    unset($values[$key]);
                } else {
                    $values[$key] = $value;
                }
                continue;
            }
        }

        return $values;
    }

    /**
     * @param array $values
     *
     * @return void
     */
    public function fromArray(array $values)
    {
        $values = array_intersect_key($values, $this->values);
        $this->values = array_merge($this->values, $values);
    }

}
