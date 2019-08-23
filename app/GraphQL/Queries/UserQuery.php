<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use GraphQL;
use App\User;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'userQuery',
        'description' => 'Uma query de users'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('user_type'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'Id Int'
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return User::all();
    }
}
