<?php

namespace Controllers;

use Model\Pago as Pago;
use DAO\PagoDAO as PagoDAO;

class PagoController
{
    public function Add( $formaDePago = '', $id = '', $dniDuenio = '', $cuilGuardian = '', $monto = '')
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

                    header("location: ../Views/pago-tarjeta.php");                      
                } else {              
                    header("location: ../Views/reserva-list-Duenio.php");
                }
            } else {
                header("location: ../Views/guardian-home.php");
            }
        } else
            header("location: ../Views/login.php");
    }


    public function SetPago($idPago, $cuilGuardian)
    {
    if (isset($_SESSION['usuario'])) {

        if ($_SESSION['tipo'] == 'D') {
            $_SESSION['idPago'] = $idPago;
            $_SESSION['cuilGuardian'] = $cuilGuardian;  
        header("location: ../Views/pago-Duenio.php");
        } else {
        session_destroy();
        header("location: ../Views/login.php");
        }
    } else
        //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
        header("location: ../Views/login.php");
    }    


    public function CompletarPago($idPago){
        if (isset($_SESSION['usuario'])) {
            if ($_SESSION['tipo'] == 'D') {
                $pagoDao = new PagoDAO();
                $pagoDao->UpdateEstado($idPago, 2);
                echo "<script> if(confirm('Pago Completado con Exito'));";  
                echo "window.location = '../Views/reserva-Historial-Duenio.php'; </script>";                 
                } else {
                session_destroy();
                header("location: ../Views/login.php");
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
                $lista = $pagoDao->getAllByDniDuenio($_SESSION['dni']);
                header("location: ../Views/pago-list-Duenio.php");
            } else {
                $lista = $pagoDao->getAllByCuilGuardian($_SESSION['cuil']);
                header("location: ../Views/pago-list-Guardian.php");
            }
        } else
            header("location: ../Views/login.php");
    }

}
