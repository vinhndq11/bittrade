<?php
/**  * Created by PhpStorm.
 * Date: 5/9/2019
 * Time: 2:54 PM
 */

namespace App\Helpers;

use Illuminate\Routing\ResourceRegistrar as OriginalRegistrar;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;

class ResourceRegistrar extends OriginalRegistrar
{
    protected $resourceAdds = ['datatable'];
    protected $addResources;
    public function __construct(Router $router)
    {
        parent::__construct($router);
        $this->resourceDefaults = array_merge($this->resourceAdds, $this->resourceDefaults);
        foreach ($this->resourceAdds as $name){
            $this->addResources[] = 'addResource' . ucwords($name);
        }
    }
    /**
     * @param $method
     * @param $arguments
     * @return Route|void
     */
    public function __call($method , $arguments)
    {
        if(in_array($method, $this->addResources))
        {
            $route = strtolower(substr($method, 11));
            list($name, $base, $controller, $options) = $arguments;
            $uri = $this->getResourceUri($name).'/'. $route;
            $action = $this->getResourceAction($name, $controller, $route, $options);
            return $this->router->get($uri, $action);
        }
    }
}
