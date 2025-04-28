<?php

class Template{
    public static function render(string $content): void{ ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Web Serie</title>

            <link href='https://fonts.googleapis.com/css?family=Pirata One' rel='stylesheet'>
            <link href='css/main.css' rel='stylesheet'>

            <style>
                html,body{
                    height: 100%;
                    margin: 0;
                    display: flex;
                    flex-direction: column;
                }

                body{
                    font-family: "Pirata One";
                    color: black;
                    background-image: url('img/MagicBG2.jpg');
                    background-size: 100%;
                    background-attachment : fixed;
                    color: white;
                }

                header{
                    width: 100%;
                    height: 80px;
                    background-color: rgba(0,0,0,0.9);
                    align-items: center;
                    display: flex;
                }

                footer{
                    height: 40px;
                    background-color: rgba(0,0,0,0.9);
                    text-align: center;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                a{
                    padding: 10px;
                    text-decoration: none;
                    color: white;
                    margin-left: 20px;
                }

                #button-header:hover{
                    background-color: rgba(0,0,0,0.8);
                }

                #injected-content{
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    flex: 1; /* pousse le footer vers le bas */
                }
                
            </style>
        </head>

        <body>
            <?php include "header.php" ?>

            <div id="injected-content">
                <?php echo $content ?>
            </div>

            <?php include "footer.php" ?>
        </body>

</html>


<?php
    }
}


?>