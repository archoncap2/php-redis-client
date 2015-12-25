<?php

namespace RedisClient\Command\Traits;

use InvalidArgumentException;
use RedisClient\Command\Command;
use RedisClient\Command\Parameter\Parameter;

trait StringsCommandsTrait {

    /**
     * APPEND key value
     * Available since 2.0.0.
     * Time complexity: O(1).
     * @link http://redis.io/commands/append
     *
     * @param string $key
     * @param string $value
     * @return int The length of the string after the append operation.
     */
    public function append($key, $value) {
        return $this->returnCommand(
            new Command('APPEND', [
                Parameter::key($key),
                Parameter::string($value),
            ])
        );
    }

    /**
     * BITCOUNT key [start end]
     * Available since 2.6.0.
     * Time complexity: O(N)
     * @link http://redis.io/commands/bitcount
     *
     * @param string $key
     * @param null|int $start
     * @param null|int $end
     * @return int The number of bits set to 1.
     */
    public function bitcount($key, $start = null, $end = null) {
        if (isset($start) xor isset($end)) {
            throw new InvalidArgumentException();
        }
        $params = [Parameter::key($key)];
        if (isset($start) && isset($end)) {
            $params[] = Parameter::integer($start);
            $params[] = Parameter::integer($end);
        }
        return $this->returnCommand(
            new Command('BITCOUNT', $params)
        );
    }

    /**
     * BITOP operation destkey key [key ...]
     * Available since 2.6.0.
     * Time complexity: O(N)
     * @link http://redis.io/commands/bitop
     *
     * @param string $operation AND, OR, XOR and NOT
     * @param string $destkey
     * @param string|string[] $keys
     * @return int The size of the string stored in the destination key,
     * that is equal to the size of the longest input string.
     */
    public function bitop($operation, $destkey, $keys) {
        return $this->returnCommand(
            new Command('BITOP', [
                Parameter::bitOperation($operation),
                Parameter::key($destkey),
                Parameter::keys($keys),
            ])
        );
    }

    /**
     * BITPOS key bit [start] [end]
     * Available since 2.8.7.
     * Time complexity: O(N)
     * @link http://redis.io/commands/bitpos
     *
     * @param string $key
     * @param string $bit
     * @param null|int $start
     * @param null|int $end
     * @return int The command returns the position of the first bit set to 1 or 0 according to the request.
     */
    public function bitpos($key, $bit, $start = null, $end = null) {
        $params = [
            Parameter::key($key),
            Parameter::string($bit),
        ];
        if (isset($start)) {
            $params[] = Parameter::integer($start);
            if (isset($end)) {
                $params[] = Parameter::integer($end);
            }
        }
        return $this->returnCommand(
            new Command('BITPOS', $params)
        );
    }

    /**
     * DECR key
     * Available since 1.0.0.
     * Time complexity: O(1)
     * @link http://redis.io/commands/decr
     *
     * @param string $key
     * @return int The value of key after the decrement
     */
    public function decr($key) {
        return $this->returnCommand(
            new Command('DECR', Parameter::key($key))
        );
    }

    /**
     * DECRBY key decrement
     * Available since 1.0.0.
     * Time complexity: O(1)
     * @link http://redis.io/commands/decrby
     *
     * @param string $key
     * @param int $decrement
     * @return int The value of key after the decrement
     */
    public function decrby($key, $decrement) {
        return $this->returnCommand(new Command('DECRBY', [
            Parameter::key($key),
            Parameter::integer($decrement),
        ]));
    }

    /**
     * GET key
     * Available since 1.0.0.
     * Time complexity: O(1)
     * @link http://redis.io/commands/get
     *
     * @param $key
     * @return string|null
     */
    public function get($key) {
        return $this->returnCommand(
            new Command('GET', Parameter::key($key))
        );
    }

    /**
     * GETBIT key offset
     * Available since 2.2.0.
     * Time complexity: O(1)
     * @link http://redis.io/commands/getbit
     *
     * @param string $key
     * @param int $offset
     * @return int The bit value stored at offset.
     */
    public function getbit($key, $offset) {
        return $this->returnCommand(
            new Command('GETBIT', [
                Parameter::key($key),
                Parameter::integer($offset),
            ])
        );
    }

    /**
     * GETRANGE key start end
     * Available since 2.4.0.
     * Time complexity: O(N) where N is the length of the returned string.
     * @link http://redis.io/commands/getrange
     *
     * @param string $key
     * @param int $start
     * @param int $end
     * @return string
     */
    public function getrange($key, $start, $end) {
        return $this->returnCommand(
            new Command('GETRANGE', [
                Parameter::key($key),
                Parameter::integer($start),
                Parameter::integer($end),
            ])
        );
    }

    /**
     * GETSET key value
     * Available since 1.0.0.
     * Time complexity: O(1)
     * @link http://redis.io/commands/getset
     *
     * @param string $key
     * @param string $value
     * @return string|null The old value stored at key, or nil when key did not exist.
     */
    public function getset($key, $value) {
        return $this->returnCommand(
            new Command('GETSET', [
                Parameter::key($key),
                Parameter::string($value),
            ])
        );
    }

    /**
     * INCR key
     * Available since 1.0.0.
     * Time complexity: O(1)
     * @link http://redis.io/commands/incr
     *
     * @param string $key
     * @return int The value of key after the increment
     */
    public function incr($key) {
        return $this->returnCommand(
            new Command('INCR', [Parameter::key($key)])
        );
    }

    /**
     * INCRBY key increment
     * Available since 1.0.0.
     * Time complexity: O(1)
     * @link http://redis.io/commands/incrby
     *
     * @param string $key
     * @param int $increment
     * @return int The value of key after the increment
     */
    public function incrby($key, $increment) {
        return $this->returnCommand(
            new Command('INCRBY', [
                Parameter::key($key),
                Parameter::integer($key),
            ])
        );
    }

    /**
     * INCRBYFLOAT key increment
     * Available since 2.6.0.
     * Time complexity: O(1)
     * @link http://redis.io/commands/incrbyfloat
     *
     * @param string $key
     * @param integer|float $increment
     * @return string
     */
    public function incrbyfloat($key, $increment) {
        return $this->returnCommand(
            new Command('INCRBYFLOAT', [
                Parameter::key($key),
                Parameter::float($increment),
            ])
        );
    }

    /**
     * MGET key [key ...]
     * Available since 1.0.0.
     * Time complexity: O(N) where N is the number of keys to retrieve.
     * @link http://redis.io/commands/mget
     *
     * @param string|string[] $keys
     * @return array
     */
    public function mget($keys) {
        $keys = (array) $keys;
        $values = $this->returnCommand(
            new Command('MGET', Parameter::keys($keys))
        );
        return array_combine($keys, $values);
    }

    /**
     * MSET key value [key value ...]
     * Available since 1.0.1.
     * Time complexity: O(N) where N is the number of keys to set.
     * @link http://redis.io/commands/mset
     *
     * @param array $keyValues
     * @return bool always TRUE since MSET can't fail.
     */
    public function mset(array $keyValues) {
        return $this->returnCommand(
            new Command('MSET', Parameter::assocArray($keyValues))
        );
    }

    /**
     * MSETNX key value [key value ...]
     * Available since 1.0.1.
     * Time complexity: O(N) where N is the number of keys to set.
     * @link http://redis.io/commands/msetnx
     *
     * @param array $keyValues
     * @return int 1 if the all the keys were set. 0 if no key was set (at least one key already existed).
     */
    public function msetnx(array $keyValues) {
        return $this->returnCommand(
            new Command('MSETNX', Parameter::assocArray($keyValues))
        );
    }

    /**
     * PSETEX key milliseconds value
     * Available since 2.6.0.
     * Time complexity: O(1)
     * @link http://redis.io/commands/psetex
     *
     * @param string $key
     * @param int $milliseconds
     * @param string $value
     * @return bool
     */
    public function psetex($key, $milliseconds, $value) {
        return $this->returnCommand(
            new Command('PSETEX', [
                Parameter::key($key),
                Parameter::integer($milliseconds),
                Parameter::string($value),
            ])
        );
    }

    /**
     * SET key value [EX seconds] [PX milliseconds] [NX|XX]
     * Available since 1.0.0.
     * Time complexity: O(1)
     * @link http://redis.io/commands/set
     *
     * @param string $key
     * @param string $value
     * @param null|int $seconds
     * @param null|int $milliseconds
     * @param null|string $exist NX - if not exist, XX - if it already exist.
     * @return bool|null
     * @throw InvalidArgumentException
     */
    public function set($key, $value, $seconds = null, $milliseconds = null, $exist = null) {
        $params = [
            Parameter::key($key),
            Parameter::string($value),
        ];
        if (isset($seconds)) {
            $params[] = Parameter::string('EX');
            $params[] = Parameter::integer($seconds);
        }
        if (isset($milliseconds)) {
            $params[] = Parameter::string('PX');
            $params[] = Parameter::integer($milliseconds);
        }
        if (isset($exist)) {
            $params[] = Parameter::nxXx($exist);
        }
        return $this->returnCommand(
            new Command('SET', $params)
        );
    }

    /**
     * SETBIT key offset value
     * Available since 2.2.0.
     * Time complexity: O(1)
     * @link http://redis.io/commands/setbit
     *
     * @param string $key
     * @param int $offset
     * @param int|bool $bit 0/1 or true/false
     * @return int The original bit value stored at offset.
     */
    public function setbit($key, $offset, $bit) {
        return $this->returnCommand(
            new Command('SETBIT', [
                Parameter::key($key),
                Parameter::integer($offset),
                Parameter::bit($bit),
            ])
        );
    }

    /**
     * SETEX key seconds value
     * Available since 2.0.0.
     * Time complexity: O(1)
     * @link http://redis.io/commands/setex
     *
     * @param string $key
     * @param int $seconds
     * @param string $value
     * @return bool
     */
    public function setex($key, $seconds, $value) {
        $Command = new Command('SETEX', $key);
        return $this->returnCommand($Command);
    }

    /**
     * SETNX key value
     * Available since 1.0.0.
     * Time complexity: O(1)
     * @link http://redis.io/commands/setnx
     *
     * @param $key
     * @return int 1 if the key was set, 0 if the key was not set
     */
    public function setnx($key, $value) {
        return $this->returnCommand(
            new Command('SETNX', [
                Parameter::key($key),
                Parameter::string($value),
            ])
        );
    }

    /**
     * SETRANGE key offset value
     * Available since 2.2.0.
     * Time complexity: O(1)
     * @link http://redis.io/commands/setrange
     *
     * @param $key
     * @return int The length of the string after it was modified by the command.
     */
    public function setrange($key, $offset, $value) {
        return $this->returnCommand(new Command('SETRANGE', [
            Parameter::key($key),
            Parameter::integer($offset),
            Parameter::string($value),
        ]));
    }

    /**
     * STRLEN key
     * Available since 2.2.0.
     * Time complexity: O(1)
     * @link http://redis.io/commands/strlen
     *
     * @param string $key
     * @return int The length of the string at key, or 0 when key does not exist.
     */
    public function strlen($key) {
        return $this->returnCommand(
            new Command('STRLEN', Parameter::key($key))
        );
    }

}