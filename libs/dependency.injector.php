<?php
class DependencyInjectorEngine
{
    private static $instances;
    
    public static function add($key, $value, $arguments = null)
    {
        self::addToInstances($key, (object) array(
            "value" => $value,
            "type" => "class",
            "arguments" => $arguments
        ));
    }

    public static function addSingleton($key, $value, $arguments = null)
    {
        self::addToInstances($key, (object) array(
            "value" => $value,
            "type" => "classSingleton",
            "instance" => null,
            "arguments" => $arguments
        ));
    }

    private static function addToInstances($key, $obj)
    {
        if (self::$instances === null) {
            self::$instances = (object) array();
        }
        self::$instances->$key = $obj;
    }

    
    public static function resolve($className, $arguments = null)
    {
        if (!class_exists($className)) {
            throw new Exception("missing class '" . $className . "'.");
        }

        $reflectionClass = new ReflectionClass($className);

        if (($constructor = $reflectionClass->getConstructor()) === null) {
            return $reflectionClass->newInstance();
        }

        if (($params = $constructor->getParameters()) === []) {
            return $reflectionClass->newInstance();
        }

        $newInstanceDependencies = [];
        foreach ($params as $param) {
            $key = $param->getType();

            if($key){
                switch(self::$instances->$key->type) {
                    case "class":
                        $newInstanceDependencies[] = self::resolve(self::$instances->$key->value, self::$instances->$key->arguments);
                    break;
                    case "classSingleton":
                        if(self::$instances->$key->instance === null) {
                            $newInstanceDependencies[] = self::$instances->$key->instance = self::resolve(self::$instances->$key->value, self::$instances->$key->arguments);
                        } else {
                            $newInstanceDependencies[]= self::$instances->$key->instance;
                        }
                    break;
                }
            }
            else
                $newInstanceDependencies[] = $param->getDefaultValue();
        }

        return $reflectionClass->newInstanceArgs(
            $newInstanceDependencies
        );
    }
}
