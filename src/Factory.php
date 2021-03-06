<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace HyperfX\Utils;

use HyperfX\Utils\Exception\NotFoundException;
use HyperfX\Utils\Exception\RuntimeException;
use HyperfX\Utils\Utils\Date;
use HyperfX\Utils\Utils\Model;
use Psr\Container\ContainerInterface;

/**
 * @property Model $model
 * @property Date $date
 */
class Factory
{
    protected $items = [];

    public function __construct(ContainerInterface $container)
    {
        $this->items = [
            'model' => $container->get(Model::class),
            'date' => $container->get(Date::class),
        ];
    }

    public function __get($name)
    {
        if (! isset($this->items[$name])) {
            throw new NotFoundException(sprintf('%s is not found.', $name));
        }

        return $this->items[$name];
    }

    public function __set($name, $value)
    {
        throw new RuntimeException('set is invalid.');
    }
}
