<!DOCTYPE html>
<html lang="pt-br">
    <head>
        {{ get_title() }}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link href="{{ static_url('assets/css/main.css') }}" rel="stylesheet" />
        <style type="text/css">
            /* CLIENT-SPECIFIC STYLES */
            body, table, td, a{
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }
            /* Prevent WebKit and Windows mobile changing default text sizes */
            table, td{
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
            }
            /* Remove spacing between tables in Outlook 2007 and up */
            img{
                -ms-interpolation-mode: bicubic;
            }
            /* Allow smoother rendering of resized image in Internet Explorer */

            /* RESET STYLES */
            img{
                border: 0;
                height: auto;
                line-height: 100%;
                outline: none; text-decoration: none;
            }
            table{
                border-collapse: collapse !important;
            }
            body{
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }

            /* iOS BLUE LINKS */
            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }

            /* MOBILE STYLES */
            @media screen and (max-width: 525px) {

                /* ALLOWS FOR FLUID TABLES */
                .wrapper {
                    width: 100% !important;
                    max-width: 100% !important;
                }

                /* ADJUSTS LAYOUT OF LOGO IMAGE */
                .logo img {
                    margin: 0 auto !important;
                }

                /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
                .mobile-hide {
                    display: none !important;
                }

                .img-max {
                    max-width: 100% !important;
                    width: 100% !important;
                    height: auto !important;
                }

                /* FULL-WIDTH TABLES */
                .responsive-table {
                    width: 100% !important;
                }

                /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
                .padding {
                    padding: 10px 5% 15px 5% !important;
                }

                .padding-meta {
                    padding: 30px 5% 0px 5% !important;
                    text-align: center;
                }

                .padding-copy {
                    padding: 10px 5% 10px 5% !important;
                    text-align: center;
                }

                .no-padding {
                    padding: 0 !important;
                }

                .section-padding {
                    padding: 50px 15px 50px 15px !important;
                }

                /* ADJUST BUTTONS ON MOBILE */
                .mobile-button-container {
                    margin: 0 auto;
                    width: 100% !important;
                }

                .mobile-button {
                    padding: 15px !important;
                    border: 0 !important;
                    font-size: 16px !important;
                    display: block !important;
                }

            }

            .mobile-button {
                font-size: 16px;
                font-family: Helvetica, Arial, sans-serif;
                color: #ffffff;
                text-decoration: none;
                border-radius: 3px;
                padding: 15px 25px;
                border: 1px solid #01933b;
                display: inline-block;
            }
            p{
                text-align: justify;
            }
            /* ANDROID CENTER FIX */
            div[style*="margin: 16px 0;"] {
                margin: 0 !important;
            }
        </style>
    </head>
    <body style="margin: 0 !important; padding: 0 !important;">


        <!-- HEADER -->
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td bgcolor="#ffffff" align="center" style="padding: 15px;">
                    <!--[if (gte mso 9)|(IE)]>
                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
                    <tr>
                    <td align="center" valign="top" width="500">
                    <![endif]-->
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
                        <tr>
                            <td>
                                <!-- COPY -->
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td align="center" valign="top" style="padding: 15px 0;" class="logo">
                                            <a href="{{ static_url() }}" target="_blank">
                                                <img alt="Logo" src="{{ static_url('assets/img/logo.jpg') }}" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;" border="0" />
                                            </a>
                                        </td>
                                        <td align="center" style="font-size: 32px; font-family: Helvetica, Arial, sans-serif; color: #333333; vertical-align: middle;" class="padding-copy">Intranet Grupo MPE</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            {{ content() }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--[if (gte mso 9)|(IE)]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
        </table>

    </body>
</html>
