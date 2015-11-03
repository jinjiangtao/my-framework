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
        return $this->getRouteInfo();
    }

    /**
     * 获取控制器和方法名
     */
    protected function getRouteInfo(){
        $returnRequst = [];
        $requestUri = ltrim($_SERVER['REQUEST_URI'],'/');
        $urlArr = explode('/',$requestUri);
        if(empty($urlArr)){

        }else{
            $returnRequst['controller'] = empty($urlArr[0])?'index':$urlArr[0];
            $returnRequst['action'] = empty($urlArr[1])?'index':trim($urlArr[1]);
        }
        return $returnRequst;
    }

}
