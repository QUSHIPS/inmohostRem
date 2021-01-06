<?php
include ("php/config.php");
include ("php/sec_head.php");

//libreria de dreamwaeaver XLST para inclucion de archivos de XML con XSLT
include(_FILE_XSL_CLASS);

// cambio la hoja de estylos por defecto
$otraCSS = "styleInterno.css";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>INMOHOST</title>
        <?php
        include("head.php");
        ?>
        <script language="javascript" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_SWF_OBJECT; ?>"></script>

        <!--MENUEXTRA-->
        <script language="JavaScript1.2" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_MENUEXTRA; ?>"></script>
        <?php echo "<style type=\"text/css\" media=\"screen\">
	@import url(\"" . _FILE_CSS_MENUEXTRA . "\");
</style>\n"; ?>
        <!--//MENUEXTRA-->

        <script language="javascript" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_TOOLTIP; ?>">

        </script>
        <script type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_TINYMCE; ?>"></script>
        <script type="text/javascript">

            tinyMCE.init(
            {mode:"textareas",
                theme:"advanced",
                skin:"o2k7",
                language: "en",
                height: '500px',
                width: '730px',
                plugins:"autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",
                theme_advanced_buttons1:"save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2:"cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                theme_advanced_buttons3:"tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                theme_advanced_buttons4:"insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
                theme_advanced_toolbar_location:"top",
                theme_advanced_toolbar_align:"left",
                theme_advanced_statusbar_location:"bottom",
                theme_advanced_resizing:true,content_css:"css/word.css",
                template_external_list_url:"lists/template_list.js",
                external_link_list_url:"lists/link_list.js",
                external_image_list_url:"lists/image_list.js",
                media_external_list_url:"lists/media_list.js",
                template_replace_values:{username:"Some User",staffid:"991234"}});
	
        </script>

    </head>
    <body>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>
                    <?php
                    // Para que muestre los servicios
                    $query = $_SERVER['QUERY_STRING'];
                  //  echo _FILE_XML_SEND_MAIL . "?" . $query;
                    $Item_xsl = new MM_XSLTransform();
                    $Item_xsl->setXML(_FILE_XML_SEND_MAIL . "?" . $query);
                    $Item_xsl->setXSL(_FILE_XSL_SEND_MAIL);
                    echo $Item_xsl->Transform();
                    ?>	</td>
            </tr>
        </table>
        <!--TOOLTIP-->
        <div id="toolTipBox">
            <iframe id="iframeToolTip" name="iframeToolTip" src="about:blank" scrolling="no" frameborder="0" style="margin:0px; padding:0px; border:none;" ></iframe>
        </div>
        <!--FIN TOOLTIP-->



                        
        

                        
                        



    </body>
</html>