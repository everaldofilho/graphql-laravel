<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL;
use App\User;

class UserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'user',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('user_type');
    }

    public function args(): array
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Nome do usuario'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Email do usuário'
            ],
            'password' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Password do usuario'
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $user = User::create([
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => bcrypt($args['password'])
        ]);

        return $user;
    }
}
