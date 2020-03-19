<?php

require_once "Wallet.php";

$wallet = new Wallet('RPC_HOST', 'RPC_PORT', 'RPC_USER', 'RPC_PASSWORD');

/*
    La variable $user debe ser el identificador único del usuario
    dentro de un sistema, por ejemplo el ID único del usuario.
*/

// Obtener lista de transacciones
$transacciones = $wallet->getTransactionList($user);

// Crear una nueva address para un usuario
$address = $wallet->getNewAddress($user);

// Obtener balance de una cuenta
$balance = $wallet->getBalance($user);

// Enviar balance a una cuenta (address)
$cantidad = 1;   // Cantidad a enviar
$response = $wallet->sendToAddress($user, $cantidad);

// Obtener balance para un address en especifico
$balance = $wallet->getReceivedByAddress($address);

?>