<?php
    require_once '../../dataaccess/Connection.php';
    require_once '../../logic/DAO/PropertyDAO.php';
    require_once '../../logic/domain/Property.php';
    $connection = new Connection();
    
    $propertyDAO = new PropertyDAO($connection);
    $properties = isset($_GET['properties']) ? unserialize(urldecode($_GET['properties'])) : [];
?>