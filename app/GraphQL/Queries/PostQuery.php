<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Posts;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class PostQuery extends Query
{
    protected $attributes = [
        'name' => 'post',
        'description' => 'A query posts'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('post_type'));
    }

    public function args(): array
    {
        return [
            'user_id' => [
                'type' => Type::int(),
                'description' => 'ID do usuário'
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();

        return Posts::all();
    }
}
