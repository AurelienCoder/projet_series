<?php

/**
 * Cette classe regroupe toutes les choses communes aux pages : le header, footer...
 */
class Template{
    public static function render(string $content): void{ ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>AlloSpoil</title>

            <link href='../css/main.css' rel='stylesheet'>
            <link href='../css/alert-infos.css' rel='stylesheet'>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
            <link href="https://fonts.cdnfonts.com/css/elegant-2" rel="stylesheet">
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
                    background-color: crimson;
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

                a{
                    padding: 10px;
                    text-decoration: none;
                    color: white;
                    margin-left: 20px;
                }

                #button-header:hover{
                    background-color: rgba(0,0,0,0.8);
                }

                #button-header{
                    margin-right: 50px;
                }

                #logo h1{
                    font-size: 40px;
                    font-weight: bold;
                    font-family: 'ELEGANT', sans-serif;
                    padding-left: 10px;
                }

                #logo a{
                    color: #fff;
                    text-decoration: none;
                }

                /* bouton rechercher du header */

                .search-input {
                    font-size: 1.3rem;
                    border: solid 1px rgba(151,19,53,0.5);
                    background: transparent;
                    color: #fff;
                    width: 20rem;
                    transition: width 0.4s ease;
                }

                .search-button {
                    background: crimson;
                    border: none;
                    cursor: pointer;
                    color: #fff;
                    font-size: 22px;
                    transition: background 0.3s ease;
                }

                .search-button:hover {
                    background: darkred;
                }

                option{
                    color: black;
                }
                
                #options-header:hover{
                    background-color: crimson;
                }

                #options-header{
                    padding: 0px;
                    margin-left: 75px;
                }

                footer{
                    background-color: black;
                    text-align: center;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    bottom: 0;
                    flex: 1;
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