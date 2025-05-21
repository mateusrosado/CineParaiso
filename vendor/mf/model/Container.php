<?php

    namespace mf\model;

    use app\core\Database;

    class Container
    {
        public static function getModel($model) {
            $class = '\\app\\models\\'.ucfirst($model);
            $conn = Database::getConnection();

            return new $class($conn);
        }
    }

?>