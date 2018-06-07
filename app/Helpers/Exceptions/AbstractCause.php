<?php
/**
 * Позволяет строго типизировать причину исключений,
 * применяется в StrictlyTypedException
 *
 * Created by PhpStorm.
 * User: cadistortion
 * Date: 6/7/18
 * Time: 10:26 AM
 */

namespace App\Helpers\Exceptions;


use MyCLabs\Enum\Enum;

abstract class AbstractCause extends Enum
{
}