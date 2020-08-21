<?php

namespace App\Manager\Aggregate;

class AbstractAggregateManager
{
    /**
     * @param $entity
     * @param $model
     * @return object
     */
    public function prepareAggregate($entity, $model)
    {
        foreach (get_class_methods($model) as $classMethod){
            if (substr($classMethod, 0, 3) == 'get'){
                if (!empty($model->$classMethod())){
                    $setter = substr_replace($classMethod, 'set', 0, 3);
                    if (method_exists($entity, $setter)){
                        $entity->$setter($model->$classMethod());
                    }
                }
            }
        }

        return $entity;
    }
}