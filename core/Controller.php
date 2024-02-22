<?php

namespace Core;

abstract class Controller
{
    abstract public function before(string $action): bool;
    abstract public function after(string $action): void;
}