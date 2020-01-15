<?php

// storage for job objects with high preformance impact (high memory usage, or time consuming operation,...) for decreas impact to preformance
// not for many small object but for resouce consuming processies

class ResourceWorker // job with resources
{
	private $id = null;
	
	function getId() {
		return $this->id;
	}
	
	function __construct($id) {
	  $this->id = $id;
	  
	  echo $this->id.": heavy performance operation".PHP_EOL;
    }
    
    public function operation()
    {
        echo $this->id.": operation with resource".PHP_EOL;
    }
}

class WorkerPool
{
	private $lastId = 0;
	
    private $occupiedWorkers = [];

    private $freeWorkers = [];

    public function get(): ResourceWorker // create worker or return free worker
    {
        if (count($this->freeWorkers) == 0) {
        	$id = ++$this->lastId;
            $worker = new ResourceWorker($id);
        } else {
            $worker = array_pop($this->freeWorkers);
        }

        $this->occupiedWorkers[$worker->getId()] = $worker;

        return $worker;
    }

    public function dispose(ResourceWorker $worker) // mark worker as free and don't destroy resource
    {
        $id = $worker->getId();

        if (isset($this->occupiedWorkers[$id])) {
            unset($this->occupiedWorkers[$id]);
            $this->freeWorkers[$id] = $worker;
        }
    }
}

$pool = new WorkerPool();

$worker1 = $pool->get(); // not resource workers created -> create new resource worker
$worker1->operation();

$worker2 = $pool->get(); // not free resource workers -> create new resource worker
$worker2->operation();

$pool->dispose($worker1); // after operation finished worker is marked as free and stored as free worker

$worker3 = $pool->get(); // one worker is marked as free -> recycle worker and return first free worker
$worker3->operation();

$worker4 = $pool->get(); // now free worker -> create new one
$worker4->operation();

$pool->dispose($worker2); // after finis mark workers as unused
$pool->dispose($worker3);
$pool->dispose($worker4);

// after all worker finished, workers used 3 resources instead of 4