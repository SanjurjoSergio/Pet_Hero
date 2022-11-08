<?php

namespace Controllers;

use Model\Imagen as Imagen;
use DAO\ImagenDAO as ImagenDAO;

class ImagenController
{
    public function Add($tipo = '')
    {
        if (isset($_SESSION['usuario'])) {
            if ($_SESSION['tipo'] == 'D') {
                if ($tipo != '') {
                    $imagen = new Imagen();

                    $imagen->setIdMascota($_SESSION['idMascota']);
                    $imagen->setTipo($tipo);
                    $imagen->setUrl("../Data/img/" . $this->SaveImg());

                    $imagenDAO = new ImagenDAO();
                    $imagenDAO->Add($imagen);

                    if ($tipo == 1) {
                        header("location: ../Views/visual-libreta-add.php");
                    } else if ($tipo == 2) {
                        echo "<script> if(confirm('Mascota Agregada con Exito'));";
                        echo "window.location = '../Views/mascota-list.php'; </script>";
                    }
                } else {
                    header("location: ../Views/visual-foto-add.php");
                }
            } else {
                header("location: ../Views/login.php");
            }
        } else {
            header("location: ../Views/login.php");
        }
    }


    public function SaveImg()
    {
        $target_dir = dirname(__DIR__) . "/Data/img/";
        $target_file = $target_dir . basename($_FILES["visual"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["visual"]["tmp_name"]);
            if ($check !== false) {
                echo "Imagen Valida - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "Imagen No Valida.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Imagen ya existe.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["visual"]["size"] > 1000000) {
            echo "La imagen debe ser de menos de 10 MB.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        ) {
            echo "Los formatos permitidos son: JPG, JPEG y PNG.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Error en la carga de la imagen.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["visual"]["tmp_name"], $target_file)) {
                echo "La imagen  " . htmlspecialchars(basename($_FILES["visual"]["name"])) . " fue cargada.";
            } else {
                echo "Error en la carga de la imagen.";
            }
        }
        return basename($_FILES["visual"]["name"]);
    }
}
