<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'UserType',
        'description' => 'Um type de usuário',
        'model' => User::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id do usuário no banco de dados'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Name do usuário no banco de dados'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'Email do usuário no banco de dados'
            ],
            'posts' => [
                'type' => Type::listOf(GraphQL::type('post_type')),
                'description' => 'Postagens'
            ]
        ];
    }
}
