<?php

$routes = [
    'index' => new \Base\Core\Router\Route\Literal(
        '/index.html', [
            'controller' => 'site',
            'action' => 'index'
        ]
    ),
    'about' => new \Base\Core\Router\Route\Literal(
        '/about.html', [
            'controller' => 'site',
            'action' => 'about'
        ]
    ),
    'designs' => new \Base\Core\Router\Route\Literal(
        '/design.html', [
            'controller' => 'site',
            'action' => 'design'
        ]
    ),
    'services' => new \Base\Core\Router\Route\Literal(
        '/services.html', [
            'controller' => 'site',
            'action' => 'services'
        ]
    ),    

//    'presshtml' => new \Base\Core\Router\Route\Literal(
//        '/press.html', [
//            'controller' => 'site',
//            'action' => 'press'
//        ]
//    ),
    
//    'presshtml' => new \Base\Core\Router\Route\Literal(
//        '/press/', [
//            'controller' => 'site',
//            'action' => 'press'
//        ]
//    ),    
    
    'press' => new \Base\Core\Router\Route\Regex(
         'press/([a-zA-Z0-9-]+)(?:/page-(\d+)){0,1}', 
        [
            'controller' => 'site',
            'action' => 'press'
        ],
        [
            1 => 'category',
            2 => 'page'
        ]
    ),  
    'pressitem' => new \Base\Core\Router\Route\Regex(
        'press/(\d+)-[a-zA-Z0-9- ]+\.html',
        [
            'controller' => 'site',
            'action' => 'pressitem'
        ],
        [
            1 => 'pressitem'
        ]        
    ),    
    'contacts' => new \Base\Core\Router\Route\Literal(
        '/contacts.html', [
            'controller' => 'site',
            'action' => 'contacts'
        ]
    ),
    'design' => new \Base\Core\Router\Route\Regex(
        'design/([a-zA-Z-]+)(?:/page-(\d+)){0,1}',
        [
            'controller' => 'site',
            'action' => 'projects'
        ],
        [
            1 => 'category',
            2 => 'page',
        ]
    ),
    'project' => new \Base\Core\Router\Route\Regex(
        '(\d+)-[a-zA-Z0-9- ]+\.html',
        [
            'controller' => 'site',
            'action' => 'project'
        ],
        [
            1 => 'project'
        ]
    ),
    'main' => new \Base\Core\Router\Route\Literal(
        '', [
            'controller' => 'site',
            'action' => 'index'
        ]
    ),
];

$routesKeys = array_keys($routes);

$languageRouter = new \Base\Core\Router\Route\Route(
    ':language',
    [
        'language' => \Base\Config::get('application')['i18n']['defaultLang'],
        'controller' => 'site',
        'action' => 'index'
    ],
    [
        'language' => '(' . implode('|', \Base\I18n::$availableLanguages) . ')'
    ]
);

$languageRoutes = [
    'language' => $languageRouter,
];

foreach ($routesKeys as $routeName) {
    $chain = new \Base\Core\Router\Route\Chain();
    $chain->chain($languageRouter)->chain($routes[$routeName]);
    $languageRoutes['language-' . $routeName] = $chain;
}

$languageRoutes['lang'] = new \Base\Core\Router\Route\Literal(
    'site/lang', [
    'controller' => 'site',
    'action' => 'lang'
]);

$languageRoutes['api-getTwit'] = new \Base\Core\Router\Route\Literal(
    '/api/get-last-tweet', [
        'controller' => 'api',
        'action' => 'getLastTweet'
    ]
);

$languageRoutes['api-image-item'] = new \Base\Core\Router\Route\Literal(
    '/api/create-image-item', [
        'controller' => 'api',
        'action' => 'createImageItem'
    ]
);

$languageRoutes['api-delete-image-item'] = new \Base\Core\Router\Route\Literal(
    '/api/delete-image-item', [
        'controller' => 'api',
        'action' => 'deleteImageItem'
    ]
);

$languageRoutes['admin'] = new \Base\Core\Router\Route\Route(
    'admin/:controller/:action',
    [
        'module' => 'admin',
        'controller' => 'main',
        'action' => 'index'
    ]
);

return $languageRoutes;