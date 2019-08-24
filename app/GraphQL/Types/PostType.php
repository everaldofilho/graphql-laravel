<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Posts;
use App\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'PostType',
        'description' => 'A type',
        'model' => Posts::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type'=> Type::ID(),
                'description' => 'ID do post'
            ],
            'title' => [
                'type'=> Type::string(),
                'description' => 'Titulo do post'
            ],
            'active' => [
                'type'=> Type::boolean(),
                'description' => 'Status do post'
            ],
            'user_id' => [
                'type'=> Type::int(),
                'description' => 'Titulo do post'
            ],
        ];
    }
}
