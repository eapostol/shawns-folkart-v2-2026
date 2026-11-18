<?

if (($sender_email == "") || ($sender_name == "") || ($message == "")) {

  header("Location:index.html ");

  exit;
}





$recipient = "touchwood@sympatico.ca";



$subject = "message from touchwooddesign.com";



$mailheaders = "From: <$sender_email> \n";

$mailheaders .= "Reply-To: <$sender_email>\n\n";



$msg = "Sender's Name:   $sender_name\n";

$msg .= "Sender's E-Mail: $sender_email\n";

$msg .= "Message:         $message\n\n";



mail($recipient, $subject, $msg, $mailheaders) or die("Couldn't send mail!");



?>

<html>

<head>

  <title>touchwooddesign.com ::Thank You for your Feedback!</title>

  <meta http-equiv="Content-Type" content="text/html;">

  <meta name="description" content="FW4 DW4 HTML">

  <!-- Fireworks 4.0  Dreamweaver 4.0 target.  Created Mon Jan 14 11:58:09 GMT-0500 (Eastern Standard Time) 2002-->

  <script language="JavaScript">
    <!--
    function MM_preloadImages() { //v3.0

      var d = document;
      if (d.images) {
        if (!d.MM_p) d.MM_p = new Array();

        var i, j = d.MM_p.length,
          a = MM_preloadImages.arguments;
        for (i = 0; i < a.length; i++)

          if (a[i].indexOf("#") != 0) {
            d.MM_p[j] = new Image;
            d.MM_p[j++].src = a[i];
          }
      }

    }

    //
    -->

  </script>

</head>

<body bgcolor="#ffffff" link="#CE3D0B" onLoad="MM_preloadImages('images/message_page_sent_final_r1_c1.jpg','images/message_page_sent_final_r2_c1.jpg','images/message_page_sent_final_r2_c2.jpg','images/message_page_sent_final_r2_c3.jpg','images/message_page_sent_final_r2_c5.jpg','images/message_page_sent_final_r2_c7.jpg','images/message_page_sent_final_r2_c8.jpg','images/message_page_sent_final_r2_c8.jpg','images/message_page_sent_final_r3_c3.jpg','images/message_page_sent_final_r3_c7.jpg','images/message_page_sent_final_r4_c3.jpg','images/message_page_sent_final_r4_c4.jpg','images/message_page_sent_final_r4_c6.jpg','images/message_page_sent_final_r5_c2.jpg','images/message_page_sent_final_r6_c2.jpg','images/tha_mountie.gif','images/tha_tattoo.gif')">

  <!--The following section is an HTML table which reassembles the sliced image in a browser.-->

  <!--Copy the table section including the opening and closing table tags, and paste the data where-->

  <!--you want the reassembled image to appear in the destination document. -->

  <!-------------------------- BEGIN COPYING THE HTML HERE ---------------------------->

  <div align="center">

    <table border="0" cellpadding="0" cellspacing="0" width="760" bgcolor="#F7DBB5" name="comments" height="420">

      <!-- fwtable fwsrc="message_page_sent_final.png" fwbase="message_page_sent_final.jpg" fwstyle="Dreamweaver" fwdocid = "742308039" fwnested="1" -->

      <tr>

        <!-- row 1 -->

        <td colspan="3"><img name="message_page_sent_final_r1_c1" src="images/message_page_sent_final_r1_c1.jpg" width="760" height="23" border="0" alt="IMAT: Members Area"></td>

      </tr>

      <tr>

        <!-- row 2 -->

        <td rowspan="2" background="images/message_page_sent_final_r2_c1.jpg" align="left" valign="top"><img name="message_page_sent_final_r2_c1" src="images/message_page_sent_final_r2_c1.jpg" width="8" height="397" border="0" alt="IMAT: Members Area" vspace="0" hspace="0"></td>

        <td>

          <table border="0" cellpadding="0" cellspacing="0" width="744">

            <tr>

              <!-- row 1 -->

              <td><img name="message_page_sent_final_r2_c2" src="images/message_page_sent_final_r2_c2.jpg" width="66" height="27" border="0" alt="IMAT: Members Area"></td>

              <td>

                <table border="0" cellpadding="0" cellspacing="0" width="678">

                  <tr>

                    <!-- row 1 -->

                    <td><img name="message_page_sent_final_r2_c3" src="images/message_page_sent_final_r2_c3.jpg" width="272" height="27" border="0" alt="IMAT: Members Area"></td>

                    <td background="images/message_page_sent_final_r2_c5.jpg" width="152" height="27">

                      <div align="center">
                        <font face="Courier New, Courier, mono"><b>
                            <font size="4">message

                              sent!</font>
                          </b></font>
                      </div>

                    </td>

                    <td><img name="message_page_sent_final_r2_c7" src="images/message_page_sent_final_r2_c7.jpg" width="254" height="27" border="0" alt="IMAT: Members Area"></td>

                  </tr>

                </table>

              </td>

            </tr>

            <tr>

              <!-- row 2 -->

              <td align="left" valign="top" background="images/message_page_sent_final_r5_c2.jpg">

                <table border="0" cellpadding="0" cellspacing="0" width="66" height="100%">

                  <tr>

                    <!-- row 1 -->

                    <td align="left" valign="top" width="0" height="0" background="images/message_page_sent_final_r3_c2.jpg" bgcolor="#F7DBB5"><img src="images/tha_mountie.gif" width="66" height="184" vspace="0" hspace="0"></td>

                  </tr>

                  <tr>

                    <!-- row 2 -->

                    <td align="left" valign="top" background="images/message_page_sent_final_r5_c2.jpg"><img name="message_page_sent_final_r5_c2" src="images/message_page_sent_final_r5_c2.jpg" width="66" height="173" border="0" alt="IMAT: Members Area"></td>

                  </tr>

                </table>

              </td>

              <td>

                <table border="0" cellpadding="0" cellspacing="0" width="678">

                  <tr>

                    <!-- row 1 -->

                    <td>

                      <table border="0" cellpadding="0" cellspacing="0" width="678">

                        <tr>

                          <!-- row 1 -->

                          <td width="424" height="140" background="images/message_page_sent_final_r3_c3.jpg">
                            <font face="Courier New, Courier, mono" size="3">Thanks,

                              <?php echo "$sender_name"; ?>

                              (

                              <?php echo "$sender_email"; ?>

                              ), for sending the following message:</font>
                          </td>

                          <td><img name="message_page_sent_final_r3_c7" src="images/message_page_sent_final_r3_c7.jpg" width="254" height="140" border="0" alt="IMAT: Members Area"></td>

                        </tr>

                      </table>

                    </td>

                  </tr>

                  <tr>

                    <!-- row 2 -->

                    <td>

                      <table border="0" cellpadding="0" cellspacing="0" width="678">

                        <tr>

                          <!-- row 1 -->

                          <td background="images/message_page_sent_final_r4_c3.jpg"><img name="message_page_sent_final_r4_c3" src="images/message_page_sent_final_r4_c3.jpg" width="52" height="217" border="0" alt="IMAT: Members Area" vspace="0" hspace="0"></td>

                          <td background="images/message_page_sent_final_r4_c4.jpg" width="314" height="217" align="left" valign="top">
                            <font face="Courier New, Courier, mono" size="2" color="#CE3D0B">

                              <?php echo "$message"; ?>

                            </font>
                          </td>

                          <td align="left" width="312" height="217" background="images/message_page_sent_final_r4_c6.jpg" valign="top"><img src="images/tha_tattoo.gif" width="312" height="217" vspace="0" hspace="0"><BR>

                            <font face="Courier New, Courier, mono" size="-1">Click

                              <a href="../scene3/index.html">here</a>

                              to return to the home page
                            </font>.
                          </td>

                        </tr>

                      </table>

                    </td>

                  </tr>

                </table>

              </td>

            </tr>

          </table>

        </td>

        <td rowspan="2"><img name="message_page_sent_final_r2_c8" src="images/message_page_sent_final_r2_c8.jpg" width="8" height="397" border="0" alt="IMAT: Members Area"></td>

      </tr>

      <tr>

        <!-- row 3 -->

        <td align="left" valign="top" background="images/message_page_sent_final_r6_c2.jpg"><img name="message_page_sent_final_r6_c2" src="images/message_page_sent_final_r6_c2.jpg" width="744" height="13" border="0" alt="IMAT: Members Area" vspace="0" hspace="0"></td>

      </tr>

      <!--   This table was automatically created with Macromedia Fireworks 4.0   -->

      <!--   http://www.macromedia.com   -->

    </table>
  </div>

  <!--------------------------- STOP COPYING THE HTML HERE --------------------------->

</body>

</html>