<?php

class indexController extends BaseController
{
    public function init(){
        parent::init();
    }

    public function  index()
    {
        $model = new ArticleModel();
        var_dump($model);
    }
}
