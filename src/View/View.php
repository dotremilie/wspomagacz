<?php

namespace Wspomagacz\Client\View;

class View {
    private string $viewPath;

    public function __construct($viewPath) {
        $this->viewPath = $viewPath;
    }

    public function render($viewName, $data = [], $title = 'Wspomagacz'): void
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