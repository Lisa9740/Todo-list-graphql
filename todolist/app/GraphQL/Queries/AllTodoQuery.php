<?php

namespace App\graphql\Queries;

use App\Models\Todo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class AllTodoQuery extends Query
{
    protected $attributes = [
        'name' => 'todos',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Todo'));
    }

    public function resolve($root, $args)
    {
        return Todo::all();
    }
}
