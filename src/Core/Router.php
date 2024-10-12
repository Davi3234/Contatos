<?php
namespace Src\Core;

use Exception;

class Router{
    /**
     * @var array{
     * GET: array<string, array{router: string, handlers: array}>,
     * POST: array<string, array{router: string, handlers: array}>,
     * PUT: array<string, array{router: string, handlers: array}>,
     * DELETE: array<string, array{router: string, handlers: array}>,
     * PATCH: array<string, array{router: string, handlers: array}>,
     * HEAD: array<string, array{router: string, handlers: array}>,
     * OPTIONS: array<string, array{router: string, handlers: array}>,
     * }
    */
    protected $routers = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => []
    ];

    public function createRouter($method, $path, $handlers) {
        $path = str_replace('//', '/', trim("/$path"));
    
        if (!$path || $path == '/')
          $path = '';
    
        foreach ($handlers as &$handler) {
          if (!is_array($handler))
            $handler = [$handler];
        }
    
        if (isset($this->routers[$method][$path]))
          throw new Exception("Router \"$method\" \"$path\" já foi definida");
    
        $this->routers[$method][$path] = [
          'router' => $path,
          'handlers' => $handlers,
        ];
      }
}