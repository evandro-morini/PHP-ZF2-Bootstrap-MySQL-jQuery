<?php
return array(
    'home' => array(
        'type' => 'Literal',
        'options' => array(
            'route' => '/',
            'defaults' => array(
                '__NAMESPACE__' => 'Application\Controller',
                'controller' => 'Pedido',
                'action' => 'index'
            )
        )
    ),
    'pedido' => array(
        'type' => 'Literal',
        'options' => array(
            'route' => '/pedido',
            'defaults' => array(
                '__NAMESPACE__' => 'Application\Controller',
                'controller' => 'Pedido',
                'action' => 'index'
            )
        ),
        'may_terminate' => true,
        'child_routes' => array(
            'cadastrar' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/cadastrar[/:id]',
                    'defaults' => array(
                        'action' => 'cadastrar',
                        'id' => '0'
                    )
                )
            ),
            'total' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/total',
                    'defaults' => array(
                        'action' => 'total'
                    )
                )
            ),
        )
    ),
    'produto' => array(
        'type' => 'Literal',
        'options' => array(
            'route' => '/produto',
            'defaults' => array(
                '__NAMESPACE__' => 'Application\Controller',
                'controller' => 'Produto',
                'action' => 'index'
            )
        ),
        'may_terminate' => true,
        'child_routes' => array(
            'cadastrar' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/cadastrar[/:id]',
                    'defaults' => array(
                        'action' => 'cadastrar',
                        'id' => '0'
                    )
                )
            ),
            'excluir' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/excluir[/:id]',
                    'defaults' => array(
                        'action' => 'excluir',
                        'id' => '0'
                    )
                )
            ),
        )
    )
);