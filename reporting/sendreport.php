<?php
include '../smtp.php';
include 'recipients.php';

$campaign = 'OCU 2018-2019';
$title = 'OCU Campaign Reporting';

$clickCapture = array(
	'subject' => $campaign . ' - clickCAPTURE Report',
	'body' => '../html/clickCaptureBody.html',
	'attachment' => 'clickCAPTURE/report.xlsx'
);

$score = array(
	'subject' => $campaign . ' - Score Report',
	'body' => '../html/scoreBody.html',
	'attachment' => 'Score/scoring.csv'
);

$inquiry = array(
	'subject' => $campaign . ' - Inquiry Report',
	'body' => file_exists('Inquiries/inquiries.csv') ? '../html/inquiryBody.html' : '../html/nodata.html',
	'attachment' => file_exists('Inquiries/inquiries.csv') ? 'Inquiries/inquiries.csv' : null
);

$iqp = array(
	'subject' => $campaign . ' - Current Inquiry Qualification Report',
	'body' => file_exists('IQP/inquiries(2).csv') ? '../html/IQR.html' : '../html/nodata.html',
	'attachment' => file_exists('IQP/inquiries(2).csv') ? 'IQP/inquiries(2).csv' : null
);

$reports = array(
	'dashboard@enrollmentfuel.com',
	$title,
	$clickCapture,
	$score,
	$inquiry,
	$iqp
);

$c = 5; // Change this value to 6 to include IQP report

for ($i = 2; $i < $c; $i++) {
	$mail -> setFrom( $reports[0], $reports[1] );
	$mail -> Subject = $reports[$i]['subject'];
	$mail -> msgHTML(file_get_contents( $reports[$i]['body'] ), dirname(__FILE__));
	$mail -> clearAttachments();
	$mail -> addAttachment( $reports[$i]['attachment'] );
	
	if (!$mail -> send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message sent!";
	}
}

unlink('clickCAPTURE/report.xlsx');
unlink('Inquiries/inquiries.csv');
unlink('Score/scoring.csv');
unlink('IQP/inquiries(2).csv');
?>