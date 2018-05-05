<?php
include 'smtp.php';
include 'recipients.php';

$subjectLines = array (
	"Make a difference and live your passion",
	"Tell us your story, ##firstname##",
	"Join our nest, ##firstname##",
	"OCishome",
	"##firstname##, make connections",
	"A lifetime of community",
	"Australia, China, Ghana, and beyond"
);

for ( $i = 0; $i < 4; $i++ ) {
	$mail -> setFrom( 'jancy.scott@oc.edu', 'Jancy Scott' );
	$mail -> Subject = $subjectLines[$i];
	$mail -> msgHTML(file_get_contents( 'search' . ($i + 1) . '.html' ), dirname(__FILE__));

	sleep(2);

	if (!$mail -> send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message sent!";
	}
}

for ( $i = 0; $i < 4; $i++ ) {
	$mail -> setFrom( 'jancy.scott@oc.edu', 'Jancy Scott' );
	$mail -> Subject = $subjectLines[$i + 4];
	$mail -> msgHTML(file_get_contents( 'nurture' . ($i + 1) . '.html' ), dirname(__FILE__));

	sleep(2);
	
	if (!$mail -> send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message sent!";
	}
}
?>