<?php

namespace Definition;

class Controller
{
    protected $view;
    protected $parameters = [];
    protected $layout = '../main/views/_layout/default.php';
    protected $request = [];

    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    public function setLayout(string $layout_path)
    {
        $this->layout = $layout_path;
    }

    public function setRequest(array $request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function setView(string $view_path)
    {
        $this->view = $view_path;
    }

    public function getView()
    {
        return $this->view;
    }

    public function render()
    {
        require $this->layout;
    }

    public function content()
    {
        require $this->view;
    }
}
