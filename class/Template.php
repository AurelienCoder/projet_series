<?php

class Template{
    public static function render(string $content): void{ ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>AlloSpoil</title>

            <link href='../css/main.css' rel='stylesheet'>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
            <style>
                html,body{
                    height: 100%;
                    margin: 0;
                    display: flex;
                    flex-direction: column;
                    color: black;
                    overflow: hidden;
                }

                body{
                    color: black;
                    background-image: url('img/MagicBG2.jpg');
                    background-size: 100%;
                    background-attachment : fixed;
                    color: black;
                }

                header{
                    width: 100%;
                    height: 80px;
                    background-color: rgba(0,0,0,0.9);
                    align-items: center;
                    display: flex;
                    justify-content: space-between;
                }

                footer{
                    height: 40px;
                    background-color: rgba(0,0,0,0.9);
                    text-align: center;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    bottom: 0;
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