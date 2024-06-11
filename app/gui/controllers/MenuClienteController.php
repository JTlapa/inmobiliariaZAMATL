<?php
session_start();
if ($_SESSION['typeUser'] != "Cliente") {
    header("Location: ./../.");
    exit();
}

require_once './../../logic/domain/User.php';
require_once './../../logic/domain/Client.php';
require_once './../../dataaccess/Connection.php';
require_once '../../logic/domain/Property.php';
require_once '../../logic/DAO/PropertyDAO.php';
require '../../logic/domain/Search.php';
require_once '../../logic/domain/SearchByProperty.php';
require_once '../../logic/DAO/SearchDAO.php';
require_once '../../logic/DAO/SearchByPropertyDAO.php';
require_once '../../logic/DAO/ClientDAO.php';

$connection = new Connection();

$propertyDAO = new PropertyDAO($connection);
$searchDAO = new SearchDAO($connection);
$searchByPropertyDAO = new SearchByPropertyDAO($connection);
$clientDAO = new ClientDAO($connection);

$ubicaciones = $propertyDAO->getAllUbications();
$tamanios = $propertyDAO->getAllSizes();

$maxPrice = $propertyDAO->getMaxPrice();
$maxRooms = $propertyDAO->getMaxRooms();

$client = $clientDAO->getClienteById($_SESSION['userId']);
if($client->getUserId() !== null) {
    $properties = $propertyDAO->getPropertiesFromClientPreferences($client);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $precio = isset($_POST['sliderPrice']) ? $_POST['sliderPrice'] : null;
    $habitaciones = isset($_POST['sliderRooms']) ? $_POST['sliderRooms'] : null;
    $ubicacion = isset($_POST['comboUbicacion']) ? $_POST['comboUbicacion'] : null;
    $tamanio = isset($_POST['comboTamanio']) ? $_POST['comboTamanio'] : null;
    $tipo = isset($_POST['searchType']) ? $_POST['searchType'] : null;

    if ($precio !== null && $habitaciones !== null && $ubicacion !== null && $tamanio !== null && $tipo !== null) {
        $search = new Search();
        $search->setIdUser($_SESSION['userId']);
        $search->setPrice($precio);
        $search->setNumberRooms($habitaciones);
        $search->setUbication($ubicacion);
        $search->setSearchType($tipo);
        $search->setDate(date("Y-m-d"));
        $search->setTerrainMeasurement($tamanio);

        $properties = $propertyDAO->getPropertiesFromSearchCriteria($search);
        $idSearch = $searchDAO->insertSearch($search);

        if ($idSearch !== -1) {
            foreach ($properties as $property) {
                $searchByProperty = new SearchByProperty();
                $searchByProperty->setIdSearch($idSearch);
                $searchByProperty->setIdProperty($property->getIdProperty());

                $searchByPropertyDAO->insertSearchByProperty($searchByProperty);
            }
        }
    }

    header("Location: ../views/Search.php?properties=" . urlencode(serialize($properties)));
    exit();
}
?>

