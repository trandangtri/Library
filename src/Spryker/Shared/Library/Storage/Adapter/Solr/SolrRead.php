<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Library\Storage\Adapter\Solr;

use Solarium\Core\Query\QueryInterface;

/**
 * Class SolrRead
 *
 * @property \Solarium\Client $resource
 */
class SolrRead extends Solr implements ReadInterface
{

    /**
     * @return \Solarium\QueryType\Select\Query\Query
     */
    public function createSelect()
    {
        return $this->getResource()->createSelect();
    }

    /**
     * @param \Solarium\Core\Query\QueryInterface $query
     *
     * @return \Solarium\QueryType\Select\Result\Result
     */
    public function select(QueryInterface $query)
    {
        return $this->getResource()->select($query);
    }

    /**
     * @return int
     */
    public function getNumDocs()
    {
        $select = $this->getResource()->createSelect();
        $result = $this->getResource()->select($select);

        return $result->getNumFound();
    }

}
