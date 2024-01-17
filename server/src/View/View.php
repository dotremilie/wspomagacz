<?php

namespace Wspomagacz\Server\View;

class View {
    private string $viewPath;

    public function __construct($viewPath) {
        $this->viewPath = $viewPath;
    }

    public function render($viewName, $data = [], $title = 'Wspomagacz API'): void
    {
        $viewFile = $this->viewPath . '/' . $viewName . '.php';

        if (file_exists($viewFile)) {
            extract($data);
            include $viewFile;
        } else {
            echo 'View not found: ' . $viewName;
        }
    }
}