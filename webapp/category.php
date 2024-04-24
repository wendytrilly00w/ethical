

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Prodotti</title>
    
    <link rel="stylesheet" href="category.css">
</head>
<body>
    <h1>Lista Prodotti</h1>
    <ul>
        <?php
        // Elenco dei file immagine dei prodotti (presumibilmente nella cartella 'img' sul server)
        $productImages = array(
            'vr1.jpg' => 'Prodotto 1',
            '2.png'   => 'Prodotto 2',
            '3.png'   => 'Prodotto 3',
            '4.png'   => 'Prodotto 4'
        );

        // Percorso della cartella delle immagini dei prodotti
        $imageDirectory = 'img/';

        // Ciclo attraverso ogni immagine prodotto e visualizza un elemento della lista
        foreach ($productImages as $imageName => $productName) {
            // Costruisci il percorso completo dell'immagine
            $imagePath = $imageDirectory . $imageName;

            // Stampa un elemento della lista con il nome del prodotto, un'anteprima dell'immagine e un collegamento all'immagine
            echo '<li>';
            echo '<a href="' . $imagePath . '" target="_blank">';
            echo '<img src="' . $imagePath . '" alt="' . $productName . '" style="max-width: 100px; max-height: 100px;">';
            echo '</a>';
            echo '<br>';
            echo $productName;
           // echo '</li>';
        }
        ?>
    </ul>
</body>
</html>
