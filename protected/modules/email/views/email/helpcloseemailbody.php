<?php
/* @var $this EmailController */
/* @var $ticketID String */
/* @var $creator String */
/* @var $closer String */
/* @var $category String */
/* @var $subject String */
/* @var $description String */
/* @var $resolution String */
?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<table width="454" border="1" cellpadding="0" cellspacing="0">
    <tr>
        <td width="450" height="401">
        <table width="452" height="403" border="0" cellpadding="5" cellspacing="0">
            <tr>
                <td height="51" align="center" valign="middle" bgcolor="#26354A" class="txt">
                <font color="#FFFFFF">Criminal Court Clerk - <font face="arial" size="&#43;1">CI2 Trouble Ticket #<?php echo $ticketID; ?></font>
                </td>
            </tr>
            <tr>
                <td height="38" align="left" valign="top" bgcolor="#FF6600">
                <h6>
                <span class="verd"><font color="#FFFFFF" face="Verdana, Geneva,sans-serif">You have received this email because
                you or someone has included you in the resolution
                for this matter. <br>
                Please see below for details.</font>  
                </span><br>
                </h6>
                </td>
            </tr>
            <tr>
                <td height="21" align="left" valign="top" bgcolor="#FFFFCC">
                &nbsp;
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" bgcolor="#FFFFCC">
                <span class="leftA"><font face="arial"><?php echo $creator; ?>, your issue has been fixed
					by <?php echo $closer; ?>. If it turns out that your issue has not been fixed, please contact IT 
					and we will reopen the ticket.<br>
                </font></span>
                </td>
            </tr>
            <tr>
                <td height="38" align="left" valign="top" bgcolor="#FFFFCC">
                <span class="leftA"><font face="arial"><b>Category:</b> <?php echo $category; ?>
                </font></span>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" bgcolor="#FFFFCC">
                <span class="leftA"><font face="arial"><b>Subject:</b> <?php echo $subject; ?></font></span>
                </td>
            </tr>
            <tr>
                <td height="29" align="left" valign="top" bgcolor="#FFFFCC">
                &nbsp;
                </td>
            </tr>
            <tr>
                <td height="73" align="left" valign="top" bgcolor="#FFFFCC"><span class="leftA">
                <font face="arial"><b>Description:</b>
                <?php echo $description; ?></font></span>
                </td>
            </tr>
            <tr>
                <td height="29" align="left" valign="top" bgcolor="#FFFFCC">
                &nbsp;
                </td>
            </tr>
            <tr>
                <td height="73" align="left" valign="top" bgcolor="#FFFFCC"><span class="leftA">
                <font face="arial"><b>Resolution:</b>
                <?php echo $resolution; ?></font></span>
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