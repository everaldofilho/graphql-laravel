<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\User;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use GraphQL;

class UserPaginateQuery extends Query
{
    protected $attributes = [
        'name' => 'userPaginate',
        'description' => 'Uma query de paginação'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('user_type');
    }

    public function args(): array
    {
        return [
            'page' => [
                'type' => type::int(),
                'description' => 'Pagina definida pela consulta'
            ],
            'paginate' => [
                'type' => type::int(),
                'description' => 'Quantidade de Registros'
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $paginate = 10;
        $page = 1;

        if (isset($args['paginate'])) {
            $paginate = $args['paginate'];
        }
        if (isset($args['page'])) {
            $page = $args['page'];
        }

        return User::paginate($paginate, ['*'], 'page', $page);
    }
}
