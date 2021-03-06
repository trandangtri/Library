<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\Library\Storage\Adapter\Solr;

use Solarium\Core\Query\QueryInterface;
use Spryker\Shared\Library\Storage\Adapter\Solr\Solarium\QueryType\Admin\Query;

/**
 * Class SolrReadWrite
 */
class SolrLocal extends Solr implements LocalInterface
{

    /**
     * @param string $type
     * @param array|null $options
     *
     * @return \Solarium\Core\Query\Query
     */
    public function createQuery($type, $options = null)
    {
        return $this->getResource()->createQuery($type, $options);
    }

    /**
     * @param \Solarium\Core\Query\QueryInterface $query
     *
     * @return \Solarium\Core\Query\Result\ResultInterface
     */
    public function execute(QueryInterface $query)
    {
        return $this->getResource()->execute($query);
    }

    /**
     * @param string $coreName
     *
     * @return void
     */
    public function reloadCore($coreName)
    {
        $query = $this->getResource()->createQuery(Query::QUERY_ADMIN);
        $query->addParam('action', 'RELOAD');
        $query->addParam('core', $coreName);
        $this->getResource()->execute($query);
    }

    /**
     * @param string $coreName
     * @param string $coreDir
     *
     * @return void
     */
    public function createCore($coreName, $coreDir)
    {
        $query = $this->getResource()->createQuery(Query::QUERY_ADMIN);
        $query->addParam('action', 'CREATE');
        $query->addParam('name', $coreName);
        $query->addParam('instanceDir', $coreDir);
        $this->getResource()->execute($query);
    }

    /**
     * @param string $coreName
     *
     * @return void
     */
    public function unloadCore($coreName)
    {
        $query = $this->getResource()->createQuery(Query::QUERY_ADMIN);
        $query->addParam('action', 'UNLOAD');
        $query->addParam('deleteIndex', 'true');
        $query->addParam('core', $coreName);
        $this->getResource()->execute($query);
    }

}
