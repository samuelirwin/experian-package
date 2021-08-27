<?php
/**
 * API Library for RAMCI reports.
 * User: Samuel Irwin
 * Date: 28/08/2021
 * Time: 4:34 AM
 */

namespace SamuelIrwin\Ramci;

use Illuminate\Support\Facades\Facade;


class RamciApiFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'RamciApi'; }
}