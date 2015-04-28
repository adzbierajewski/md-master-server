<?php
require_once "library/Server.php";

header('Content-Type: text/csv');

function GenerateCSV() {
	$servers = Server::getServerList();

	$output = "";

	foreach($servers as $s) {
		//Write server values into a line (separated by tabs)
		$output.=$s->getPublicKey()."\t";
		$output.=$s->getName()."\t";
		$output.=$s->getMotd()."\t";
		$output.=$s->getPort()."\t";
		$output.=$s->getAddress()."\t";
		$output.=$s->getVersion()."\t";
		$output.=$s->getUserCount()."\t";
		$output.=$s->getMaxClients()."\t";
		$output.=$s->getGameMode()."\t";
		$output.=$s->getUserList()."\n";	//Terminate server entry using line break
	}
	return $output;
}
echo GenerateCSV();
?>
