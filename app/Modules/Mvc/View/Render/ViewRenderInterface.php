<?php
/**
 * Created by PhpStorm.
 * User: cadistortion
 * Date: 4/5/18
 * Time: 3:00 PM
 */

namespace App\Modules\Mvc\View\Render;


interface ViewRenderInterface extends RenderInterface
{
    public function setViewName($view_name);
    public function setTemplatesPath(array $templates_path);
    public function setViewModel($view_model);
}