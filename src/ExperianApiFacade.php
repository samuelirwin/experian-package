<?php
/**
 * API Library for EXPERIAN reports.
 * User: Samuel Irwin
 * Date: 28/08/2021
 * Time: 4:34 AM
 */

namespace SamuelIrwin\Experian;

use Illuminate\Support\Facades\Facade;


class ExperianApiFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'ExperianApi'; }
}