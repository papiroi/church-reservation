<?php 
	$No = 1; 
	$Name = 'John'; 
	$Test = 'Science';

	//Download header
	$document->save($doc);
	header('Content-Description: File Transfer');
	//header('Content-Type: application/msword');
	header('Content-Type: application/octet-stream');
	//header("Content-Disposition: attachment; filename='$No_$Name_$Test.docx");
	header("Content-Disposition: attachment; filename=\"{$No}_{$Name}_{$Test}.docx\"");
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($doc));
	ob_clean();
	flush();
	readfile($doc);