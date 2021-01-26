<?php

namespace App\graphql\Mutations;

use App\Models\Todo;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateTodoMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createTodo'
    ];

    public function type(): Type
    {
        return GraphQL::type('Todo');
    }

    public function args(): array
    {
        return [
            'title' => [
                'name' => 'title',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'execution_date' => [
                'name' => 'execution_date',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'priority' => [
                'name' => 'priority',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'is_execute' => [
                'name' => 'is_execute',
                'type' =>  Type::nonNull(Type::boolean()),
            ]

        ];
    }

    public function resolve($root, $args)
    {
        $todo = new Todo();
        $todo->fill($args);
        $todo->save();

        return $todo;
    }
}
