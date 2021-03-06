<?php
/**
 * Причина исключения репозитория
 *
 * Created by PhpStorm.
 * User: cadistortion
 * Date: 6/7/18
 * Time: 5:37 PM
 */

namespace App\DAL;


use App\Helpers\Exceptions\ExceptionCause;

class RepositoryExceptionCause extends ExceptionCause
{
    public const ENTITY_ALREADY_EXISTS = 'Repository entity already exists!';
}