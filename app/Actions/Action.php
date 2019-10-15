<?php

namespace App\Actions;

abstract class Action
{
    /**
     * Create a new action instance.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parseParameters($parameters);
    }

    /**
     * The static alise function to execute the action.
     *
     * @param  array   $parameters
     * @return mixed
     */
    public static function run(array $parameters = [])
    {
        return (new static($parameters))->execute();
    }

    /**
     * Parsing a parameters array to properties.
     *
     * @param  array  $parameters
     * @return void
     */
    protected function parseParameters(array $parameters): void
    {
        array_walk($parameters, function ($value, $key) {
            if (property_exists(get_called_class(), $key)) {
                $this->{$key} = $value;
            }
        });
    }
}
