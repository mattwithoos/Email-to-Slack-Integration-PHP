<style>
div.toggler { border:1px solid #ccc; background:url(gmail2.jpg) 10px 12px #eee no-repeat; cursor:pointer; padding:10px 32px; }
div.toggler .subject { font-weight:bold; }
div.read { color:#666; }
div.toggler .from, div.toggler .date { font-style:italic; font-size:11px; }
div.body { padding:10px 20px; }
</style>


<?php
include 'config.php';

$uid = $_GET['uid'];
$secret = $_GET['secret'];

$mailbox = imap_open(MAIL_HOST,MAIL_USER,MAIL_PASS) or die('Cannot connect: ' . imap_last_error());

$overview = imap_fetch_overview($mailbox,$uid,1);

$message = imap_fetchbody($mailbox,$uid,1.2,FT_UID);
// Mail might not be in TEXT/HTML format so this is a fallback:
if(empty($message)) {
  $message = imap_fetchbody($mailbox,$uid,2,FT_UID);
}
// Clean the email body up for viewing
$message = quoted_printable_decode($message);

/* output the email header information */
$output = "";
$output.= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
$output.= '<span class="subject">'.$overview[0]->subject.'</span> ';
$output.= '<span class="from">'.$overview[0]->from.'</span>';
$output.= '<span class="date">on '.$overview[0]->date.'</span>';
$output.= '</div>';

/* output the email body */
$output.= '<div class="body">'.$message.'</div>';


if($secret == md5($salt.$overview[0]->udate)) {
  echo $output;
} else {
  echo "Invalid key. Access denied.";
}


/* close the connection */
imap_close($mailbox);

?>
