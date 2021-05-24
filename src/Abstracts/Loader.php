<?php

namespace Scaffold\Essentials\Abstracts;

use Scaffold\Essentials\Essentials;

use Scaffold\Essentials\Contracts\CacheInterface;

use Scaffold\Essentials\Contracts\LoaderInterface;

abstract class Loader implements LoaderInterface {

  protected $queue;
  
  protected $container;

  protected $group = 'loadergroup';

  public function __construct ( CacheInterface $storage, Essentials $container ) {

    $this->queue = $storage;

    $this->container = $container;
  }

  protected function add ( string $queue, $value ): void {

    if ( ! $this->queue->get( $queue, $this->group ) ) {

      $this->queue->set( $queue, [], $this->group );
    }

    $queued = $this->queue->get( $queue, $this->group );

    array_push( $queued, $value );

    $this->queue->set( $queue, $queued, $this->group );
  }

  protected function reset (): void {

    $this->queue->flush();
  }

  abstract public function load (): void;
}