<h2>Contactez-nous :</h2>
    <?php  
    define( 'MAIL_TO', /* >>>>> */''/* <<<<< */ );  
    define( 'MAIL_FROM', '' ); 
    define( 'MAIL_OBJECT', '' ); 
    define( 'MAIL_MESSAGE', '' );  

    $mailSent = false;  
    $errors = array(); 
      
    if( filter_has_var( INPUT_POST, 'send' ) )
    {  
        $from = filter_input( INPUT_POST, 'from', FILTER_VALIDATE_EMAIL );  
        if( $from === NULL || $from === MAIL_FROM )
        {  
            $errors[] = 'Vous devez renseigner votre adresse de courrier électronique.';  
        }  
        elseif( $from === false ) 
        {  
            $errors[] = 'L\'adresse de courrier électronique n\'est pas valide.';  
            $from = filter_input( INPUT_POST, 'from', FILTER_SANITIZE_EMAIL );  
        }  

        $object = filter_input( INPUT_POST, 'object', FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_HIGH | FILTER_FLAG_ENCODE_LOW );  
        if( $object === NULL OR $object === false OR empty( $object ) OR $object === MAIL_OBJECT ) 
        {  
            $errors[] = 'Vous devez renseigner l\'objet.';  
        }  

 
        $message = filter_input( INPUT_POST, 'message', FILTER_UNSAFE_RAW );  
        if( $message === NULL OR $message === false OR empty( $message ) OR $message === MAIL_MESSAGE ) 
        {  
            $errors[] = 'Vous devez écrire un message.';  
        }  

        if( count( $errors ) === 0 )
        {  
            if( mail( MAIL_TO, $object, $message, "From: $from\nReply-to: $from\n" ) ) 
            {  
                $mailSent = true;  
            }  
            else 
            {  
                $errors[] = 'Votre message n\'a pas été envoyé.';  
            }  
        }  
    }  
    else 
    {  
        $from = MAIL_FROM;  
        $object = MAIL_OBJECT;  
        $message = MAIL_MESSAGE;  
    }  
?>
 <?php  
    if( $mailSent === true )
    {  
?>  
        <p id="success">Votre message a bien été envoyé.</p>  
        <p><strong>Courriel pour la réponse :</strong><br /><?php echo( $from ); ?></p>  
        <p><strong>Objet :</strong><br /><?php echo( $object ); ?></p>  
        <p><strong>Message :</strong><br /><?php echo( nl2br( htmlspecialchars( $message ) ) ); ?></p>  
<?php  
    }  
    else 
    {  
        if( count( $errors ) !== 0 )  
        {  
            echo( "\t\t<ul>\n" );  
            foreach( $errors as $error )  
            {  
                echo( "\t\t\t<li>$error</li>\n" );  
            }  
            echo( "\t\t</ul>\n" );  
        }  
        else  
        {  
            echo( "\t\t<p id=\"welcome\"><em>Tous les champs sont obligatoires</em></p>\n" );  
        }  
?>  

        <form id='contact' method="post" action="<?php echo( $_SERVER['REQUEST_URI'] ); ?>">  
            <p>  
                <label for="from">Votre adresse e-mail :</label>  
                <input type="text" name="from" id="from" value="<?php echo( $from ); ?>" />  
            </p>  
            <p>  
                <label for="object">Objet :</label>  
                <input type="text" name="object" id="object" value="<?php echo( $object ); ?>"style="margin-left: 105px;"/>  
            </p>   
            <p>  
                <label for="message">Message :</label> </br> 
                <textarea name="message" id="message" rows="6" cols="50"><?php echo( $message ); ?></textarea>  
            </p>  
            <p>  
                <input type="reset" name="reset" value="Effacer" />  
                <input type="submit" name="send" value="Envoyer" />  
            </p>  
        </form>  
<?php  
    }  
?>  