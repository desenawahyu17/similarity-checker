<?php
	include ( '../../PdfToText.phpclass' ) ;

	function  output ( $message )
	   {
		if  ( php_sapi_name ( )  ==  'cli' )
			echo ( $message ) ;
		else
			echo ( nl2br ( $message ) ) ;
	    }

	$file	=  'sample' ;
	$pdf	=  new PdfToText ( "$file.pdf" ) ;

	output ( "Extracted file contents :\n" ) ;
	output ( $pdf -> Text ) ;