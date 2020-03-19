<?php

require_once 'Bitcoin.php';
 
class Wallet {
	private $uri;
	private $jsonrpc;

	function __construct($host, $port, $user, $pass)
	{
		$this->uri = "http://" . $user . ":" . $pass . "@" . $host . ":" . $port . "/";
		//$this->jsonrpc = new jsonRPCClient($this->uri);
		$this->jsonrpc = new Bitcoin($user,$pass,$host,$port);
	}

	function sendToAddress($address,$amount){
		return $this->jsonrpc->sendtoaddress($address,$amount);
	}

	function getInfo()
	{
		return $this->jsonrpc->getconnectioncount();
	}

	function getBalance($user_session)
	{
		return $this->jsonrpc->getbalance("wallet(" . $user_session . ")", 3);
	}

	function getBalancePending($user_session)
	{
		return $this->jsonrpc->getbalance("wallet(" . $user_session . ")",0);
	}

	function getReceivedByAddress($address){
		return $this->jsonrpc->getreceivedbyaddress($address, 0);
	}

    function getAddress($user_session){
        return $this->jsonrpc->getaccountaddress("wallet(" . $user_session . ")");
	}

	function getAddressList($user_session)
	{
		return $this->jsonrpc->getaddressesbyaccount("wallet(" . $user_session . ")");
	}

	function getreceivedbyaccount($user_session){
		return $this->jsonrpc->getreceivedbyaccount("wallet(" . $user_session . ")",0);
	}

	function getTransactionList($user_session, $count = 10)
	{
		return $this->jsonrpc->listtransactions("wallet(" . $user_session . ")", $count);
	}

	function getNewAddress($user_session)
	{
		return $this->jsonrpc->getnewaddress("wallet(" . $user_session . ")");
	}

	function move($user_from, $user_to, $amount)
	{
		return $this->jsonrpc->move("wallet($user_from)","wallet($user_to)",$amount);
	}

	function withdraw($user_session, $address, $amount)
	{
		return $this->jsonrpc->sendfrom("wallet(" . $user_session . ")", $address, $amount, 0);
	}

	function listunspent($i,$j){
		return $this->jsonrpc->listunspent($i,$j,$this->jsonrpc->getaddressesbyaccount(""));
	}

	function createrawtransaction($address,$estimated){
		return $this->jsonrpc->createrawtransaction($address,$estimated);
	}

}
?>
