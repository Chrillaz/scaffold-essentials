<?php

namespace Scaffold\Essentials\Contracts;

interface ShortcodeInterface {

  public function register ( array $attributes ): string;
}