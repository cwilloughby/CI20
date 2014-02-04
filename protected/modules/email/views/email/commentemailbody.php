<?php
/* @var $this EmailController */
/* @var $ticketID String */
/* @var $user String */
/* @var $content String */
/* @var $category String */
/* @var $subject String */
/* @var $ticketBody String */
?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<table width="454" border="1" cellpadding="0" cellspacing="0">
    <tr>
        <td width="450" height="301">
        <table width="452" height="303" border="0" cellpadding="5" cellspacing="0">
            <tr>
                <td height="51" align="center" valign="middle" bgcolor="#26354A" class="txt">
                <font color="#FFFFFF">Criminal Court Clerk - <font face="arial" size="&#43;1">CI2 Trouble Ticket #<?php echo $ticketID; ?></font>
                </td>
            </tr>
            <tr>
                <td height="21" align="left" valign="top" bgcolor="#FFFFCC">
                &nbsp;
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" bgcolor="#FFFFCC">
                <span class="leftA"><font face="arial">
                A new comment on CI2 ticket #<?php echo $ticketID; ?> was made by </h1> <?php echo $user; ?>
                </font></span>
                </td>
            </tr>
            <tr>
                <td height="29" align="left" valign="top" bgcolor="#FFFFCC">
                &nbsp;
                </td>
            </tr>
            <tr>
                <td height="73" align="left" valign="top" bgcolor="#FFFFCC"><span class="leftA">
                <font face="arial"><b>Content:</b>
                <?php echo $content; ?></font></span>
                </td>
            </tr>
            <tr>
                <td height="29" align="left" valign="top" bgcolor="#FFFFCC">
                &nbsp;
                </td>
            </tr>
        </table>
        </td>
    </tr>
</table>

<br/>

<font size="&#43;1"><b>Original Ticket Message:</b></font><br/>

<?php
$this->renderPartial('helpopenemailbody', 
	array(
		'ticketID' => $ticketID,
		'user' => $user,
		'category' => $category,
		'subject' => $subject,
		'description' => $ticketBody
	))
?>
