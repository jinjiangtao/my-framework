<?php
/**
 * http 请求的路由控制中心
 * Class RouteHttp
 */
class RouteHttp extends RouteBase{
    /**
     *
     */
    public function getRoute(){
        Debug::html_dump($_SERVER);
        $this->getRouteInfo();
    }

    /**
     *
     */
    protected function getRouteInfo(){

    }


}
