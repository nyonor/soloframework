<?php
/**
 * Точка входа в приложение через веб-сервер
 *
 * Created by PhpStorm.
 * User: NyoNor
 * Date: 2/9/2018
 * Time: 12:16 PM
 */

use App\Ioc\Ioc;
use App\Modules\ModuleArgumentInterface;
use App\Modules\Mvc\Controller\ActionResult\ActionResultFactoryInterface;
use App\Modules\Mvc\Controller\MvcControllerFactoryInterface;
use App\Modules\Mvc\MvcModuleInterface;
use App\Http\RequestInterface;
use App\Http\ResponseInterface;
use App\Modules\Mvc\Routing\RoutingInterface;
use App\Modules\Mvc\View\Render\ViewRenderInterface;
use App\Pipeline\ModuleArgumentHandlerInterface;
use App\Pipeline\PipelineInterface;
use App\Pipeline\ResponseHandlerInterface;

require_once("../app/Autoload/AutoloaderInterface.php");

//Инклудим конфиг
require_once("../app/Config/Config.php");

// Инклудим автозагрузчик
require_once ("../vendor/autoload.php");

//здесь можно зарегистрировать еще автозагрузчики!

//создание пайплайна, модулей, регистрация модулей в пайплайне
/**
 * @var $pipe_line PipelineInterface
 */
$pipeline_handler = Ioc::factory(ModuleArgumentHandlerInterface::class);
$response_handler = Ioc::factory(ResponseHandlerInterface::class);
$pipe_line = Ioc::factoryWithVariadic(PipelineInterface::class, $pipeline_handler, $response_handler);
$view_renderer = Ioc::factory(ViewRenderInterface::class);
$action_result_factory = Ioc::factoryWithArgs(ActionResultFactoryInterface::class, $view_renderer);
$routing = Ioc::factory(RoutingInterface::class);
$controller_factory = Ioc::factory(MvcControllerFactoryInterface::class);
$mvc_module = Ioc::factoryWithVariadic(MvcModuleInterface::class, $routing, $controller_factory,
    $action_result_factory);
$pipe_line->registerModule($mvc_module);

//создание объектов реквест и респонс

$request = Ioc::factory(RequestInterface::class);
$response = Ioc::factory(ResponseInterface::class);

//запуск обработки

$pipe_line->go(Ioc::factoryWithArgs(ModuleArgumentInterface::class, [
    'request'   => $request,
    'response'  => $response
]));
