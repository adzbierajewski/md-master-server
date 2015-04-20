<?php
class Config {
	const
	dbserver = "localhost",
	dbusername = "manicdigger",
	dbpassword = "manicdigger",
	dbname = "manicdigger_manicdigger",
	webServerHash = "", //Private key that is unique to the webserver, never share this.
	passwordRounds = 8; //Number of rounds that password is encrypted, higher numbers take longer and are more secure.
}