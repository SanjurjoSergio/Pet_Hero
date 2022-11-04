<?php

namespace Controllers;

use Model\Pago as Pago;
use DAO\PagoDAO as PagoDAO;

class PagoController
{
    public function Add($id = '', $monto = '', $formaDePago = '', $dniDuenio = '', $cuilGuardian = '')
    {
        if (isset($_SESSION['usuario'])) {
            if ($_SESSION['tipo'] == 'D') {
                if ($monto != '' || $formaDePago != '') {
                    $pago = new Pago();

                    $pago->setId($id);
                    $pago->setDniDuenio($dniDuenio);
                    $pago->setCuilGuardian($cuilGuardian);
                    $pago->setMonto($monto);
                    $pago->setEstado(1);
                    $pago->setFormaDePago($formaDePago);
                    $pago->setFecha(date('Y-m-d'));

                    $pagoDao = new pagoDAO();
                    $pagoDao->Add($pago);

                    header("location: ../Views/reserva-list-Duenio.php"); 
                } else {
                    $_SESSION['idPago'] = $id; 
                    header("location: ../Views/pago-Duenio.php");
                }
            } else {

                header("location: ../Views/guardian-home.php");
            }
        } else
            header("location: ../Views/login.php");
    }

   


    public function List($mensaje = '')
    {
        if (isset($_SESSION['usuario'])) {
            $pagoDao = new PagoDao();
            $lista = array();
            if ($_SESSION['tipo'] == 'D') {
                $lista = $pagoDao->getByDniDuenio($_SESSION['dni']);
                header("location: ../Views/pago-list-Duenio.php");
            } else {
                $lista = $pagoDao->getByCuilGuardian($_SESSION['cuil']);
                header("location: ../Views/pago-list-Guardian.php");
            }
        } else
            header("location: ../Views/login.php");
    }
/*
    public function SetResenia($idReserva, $cuilGuardian)
    {
        if (isset($_SESSION['usuario'])) {

            if ($_SESSION['tipo'] == 'D') {
                $_SESSION['idReserva'] = $idReserva;
                $_SESSION['cuilGuardian'] = $cuilGuardian;
                header("location: ../Views/resenia-add.php");
            } else {
                session_destroy();
                header("location: ../Views/login.php");
            }
        } else
            //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
            header("location: ../Views/login.php");
    }


    public function SetReseniaUpdate($idResenia)
    {
        if (isset($_SESSION['usuario'])) {

            if ($_SESSION['tipo'] == 'D') {
                $_SESSION['idResenia'] = $idResenia;
                header("location: ../Views/resenia-home.php");
            } else {
                session_destroy();
                header("location: ../Views/login.php");
            }
        } else
            //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
            header("location: ../Views/login.php");
    }

    public function UpdateResenia($puntaje = '', $observaciones = '', $idResenia)
    {
        if (isset($_SESSION['usuario'])) {
            if ($_SESSION['tipo'] == 'D') {
                if ($puntaje != '' || $observaciones != '') {
                    $reseniaDao = new ReseniaDAO();
                    $reseniaDao->UpdatePuntaje($idResenia, $puntaje);
                    $reseniaDao->UpdateObservaciones($idResenia, $observaciones);

                    // $this->List('El puntaje fue actualizado');
                    header("location: ../Views/resenia-list-Duenio.php");
                } else {
                    header("location: ../Views/resenia-update.php");
                    //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\resenia-update.php');
                }
            } else {
                session_destroy();
                header("location: ../Views/login.php");
                //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\resenia-list.php');
            }
        } else {
            header("location: ../Views/login.php");
            //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
        }
    }


    public function Delete($id)
    {
        if (isset($_SESSION['usuario']))
            if ($_SESSION['tipo'] == 'D') {
                $reseniaDao = new ReseniaDAO();
                $reseniaDao->Delete($id);
                $this->List('El registro fue eliminado');
            } else {
                require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\resenia-list.php');
            }
        else
            require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
    }*/
}
