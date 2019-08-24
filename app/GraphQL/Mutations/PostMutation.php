<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use GraphQL;
use App\Posts;

class PostMutation extends Mutation
{
    protected $attributes = [
        'name' => 'post',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('post_type');
    }

    public function args(): array
    {
        return [
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Titulo do Post'
            ],
            'active' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'Status do Post'
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID do usuário'
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $post = Posts::create([
            'title' => $args['title'],
            'active' => $args['active'],
            'user_id' => $args['user_id'],
            'craeted_at' => today(),
            'updated_at' => today(),
        ]);

        return $post;
    }
}
