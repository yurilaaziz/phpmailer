<?php
require("mailer.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>.:: Simple PHP Mailer ::.</title>
<link rel="stylesheet" href="css/style.css" />
<link href='http://fonts.googleapis.com/css?family=Engagement' rel='stylesheet' type='text/css'>

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>

</head>
<body>
<article>
<h1>PHP Mailer</h1>
<p>
<pre><?php
echo $errorMessage;

echo $succMessage;
?>
</pre></p>
<form method="post" >
	<ul>
        <li>
        	<label for="to">To:</label>
              <textarea cols="50" rows="2" name="to"></textarea>
			  </li>
        <li>
        	<label for="from">From:</label>
            <input type="email" size="40" name="from" />
        </li>
        <li>
        	<label for="subject">Subject:</label>
            <input type="text" size="40" name="subject" />
        </li>
        
		<li>
            <label><input type="radio" name="html" /> with html</label>
            <label><input type="radio" name="html" /> no html</label>
        </li>
        <li>
        	<label for="message">Message:</label>
            <textarea cols="80" rows="7" name="message"></textarea>
		</li>
	</ul>
    <p>
        <button type="submit" class="action">Send</button>
        <button type="reset" class="right">Reset</button>
    </p>
</form>
</article>
<footer>
<p>Free as in freedom, follow <a href="https://twitter.com/asker_amine" alt="Twitter">@asker_amine</a></p>
</footer>
