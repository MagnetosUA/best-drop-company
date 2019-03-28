<?php

namespace DropBundle\Services;

use DropBundle\Repository\OrdRepository;

class StatusCountProcessor
{
    /**
     * @var OrdRepository
     */
    private $ordRepository;

    /**
     * StatusCountProcessor constructor.
     * @param OrdRepository $ordRepository
     */
    public function __construct(OrdRepository $ordRepository)
    {
        $this->ordRepository = $ordRepository;
    }

    /**
     * @return mixed
     */
    public function getStatusesCount()
    {
        $statuses = $this->ordRepository->findCountStatuses();

        $statusCount["new"] = $statuses[0]['COUNT(status)'];
        $statusCount["in_processing"] = $statuses[1]['COUNT(status)'];
        $statusCount["confirmed"] = $statuses[2]['COUNT(status)'];
        $statusCount["rejected"] = $statuses[3]['COUNT(status)'];
        $statusCount["shipped"] = $statuses[4]['COUNT(status)'];
        $statusCount["non_purchase"] = $statuses[5]['COUNT(status)'];

        return $statusCount;
    }
}
