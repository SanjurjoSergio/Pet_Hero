<?php

namespace Controllers;

use Model\Video as Video;
use DAO\VideoDAO as VideoDAO;

class VideoController
{
    public function Add()
    {
        if (isset($_SESSION['usuario'])) {
            if ($_SESSION['tipo'] == 'D') {

                $video = new Video();

                $video->setIdMascota($_SESSION['idMascota']);
                $video->setUrl("../Data/video/" . $this->SaveVid());

                $videoDAO = new VideoDAO();
                $videoDAO->Add($video);

                header("location: ../Views/mascota-home.php");

            } else {
                header("location: ../Views/login.php");
            }
        } else {
            header("location: ../Views/login.php");
        }
    }


    public function SaveVid()
    {
        $target_dir = dirname(__DIR__) . "/Data/video/";
        $target_file = $target_dir . basename($_FILES["visual"]["name"]);
        $uploadOk = 1;
        $videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = filesize($_FILES["visual"]["tmp_name"]);
            if ($check !== false) {
                echo "Video Valido - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "Video No Valido.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Video ya existe.";
            $uploadOk = 0;
        }
         // Check file size
         if ($_FILES["visual"]["size"] > 15000000) {
            echo "La imagen debe ser de menos de 150 MB.";
            $uploadOk = 0;
        }
        // Allow certain file formats 
        if (
            $videoFileType != "mp4" && $videoFileType != "webm"
        ) {
            echo "Los formatos permitidos son: MP4 y WebM.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Error en la carga del video.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["visual"]["tmp_name"], $target_file)) {
                echo "El video  " . htmlspecialchars(basename($_FILES["visual"]["name"])) . " fue cargado.";
            } else {
                echo "Error en la carga del video.";
            }
        }
        return basename($_FILES["visual"]["name"]);
    }
}
