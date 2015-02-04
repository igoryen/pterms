<?php

return array(
  'controllers' => array(
    'invokables' => array(
      'Term\Controller\Term' => 'Term\Controller\TermController',
    ),
  ),
  
  'router' => array(
    'routes' => array(
      'album' => array(
        'type' => 'segment',
        'options' => array(
          'route' => '/term[/:action][/:id]',
          'constraints' => array(
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[0-9]+',
          ),
          'defaults' => array(
            'controller' => 'Term\Controller\Term',
            'action' => 'index',
          ),
        ),
      ),
    ),
  ),
  
  'view_manager' => array(
    'template_path_stack' => array(
      'album' => __DIR__ . '/../view',
    ),
  ),
);