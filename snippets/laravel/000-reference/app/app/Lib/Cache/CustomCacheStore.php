<?php

namespace App\Lib\Cache;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Cache\TaggableStore;
use Illuminate\Cache\DatabaseStore;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Contracts\Cache\Lock as LockContract;
use Illuminate\Contracts\Cache\LockProvider;

class CustomCacheStore extends TaggableStore implements Store, LockProvider
{
    private $databaseStore = null;

    public function __construct(ConnectionInterface $connection, $table, $prefix = '')
    {
        $this->databaseStore = new DatabaseStore($connection, $table, $prefix);
    }

    public function get($key = NULL) {
        return $this->databaseStore->get($key);
    }

    public function many(array $keys) {
        return $this->databaseStore->many($keys);
    }

    public function put($key, $value, $seconds) {
        return $this->databaseStore->put($key, $value, $seconds);
    }

    public function putMany(array $values, $seconds) {
        return $this->databaseStore->putMany($values, $seconds);
    }

    public function increment($key, $value = 1) {
        return $this->databaseStore->increment($key, $value);
    }

    public function decrement($key, $value = 1) {
        return $this->databaseStore->decrement($key, $value);
    }

    public function forever($key, $value) {
        return $this->databaseStore->forever($key, $value);
    }

    public function forget($key) {
        return $this->databaseStore->forget($key);
    }

    public function flush() {
        return $this->databaseStore->flush();
    }

    public function getPrefix() {
        return $this->databaseStore->getPrefix();
    }

    /* for lock */
    public function lock($name, $seconds = 0, $owner = null) {
        throw new \Exception("Not implemented");
    }

    public function restoreLock($name, $owner) {
        throw new \Exception("Not implemented");
    }
}
