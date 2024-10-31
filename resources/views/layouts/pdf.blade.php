<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Document PDF')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>

        .header-table {
            width: 100%; /* Utiliser toute la largeur disponible */
            margin-bottom: 20px;
        }
        .armoirie{
            max-width: 100px; /* Ajustez la taille des images */
            height: auto; /* Garder les proportions */
        }
        .logo
        {
            max-width: 180px; /* Ajustez la taille des images */
            height: auto; /* Garder les proportions */
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 5px;
            margin-bottom: 5px;
            margin-top: 0px
        }
        .title-container {
            text-align: center; /* Centre le contenu à l'intérieur */
        }
        h4 {
            display: inline-block; /* Réduit la largeur au texte uniquement */
            color: #070707; /* Couleur grise similaire à Bootstrap */
            border: double 3px #0a0a0a; /* Double bordure */
            padding: 5px; /* Réduit l'espacement entre le texte et les bordures */
            padding-left: 20px;
            padding-right: 20px;
            font-size: 20px;
        }
        .container {
            margin: 0 auto;
            width: 100%;
        }
        .card {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            margin-bottom: 10px;
            padding: 20px;
        }
        .card-header {
            background-color: #f8f9fa;
            font-weight: bold;
            border-bottom: 1px solid #dee2e6;
        }
        .card-body {
            padding: 5px;
        }
        .text-center {
            text-align: center;
        }
        .mb-3 {
            margin-bottom: 1rem;
        }
        .signature-section {
         width: 100%; /* Assurez-vous que le tableau occupe toute la largeur */
         border-collapse: collapse;
        }

        .signature-card {
            text-align: center; /* Centre le texte à l'intérieur de chaque cellule */
            border: 1px solid #dee2e6;
            padding: 10px; /* Espacement interne */
        }
        ul {
            list-style-type: none; /* Pour supprimer les puces */
            padding: 0;
        }
        li {
            margin-bottom: 5px;
        }
        .date{
            text-align:right;
        }

        .card-body p{
            font-size: 14px; /* Réduction de la taille de la police */
        }
        .footer p {
                 font-size: 11px; /* Réduction de la taille de la police */
         }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td style="text-align: left;">
                <img class="logo" src="{{ public_path('img/logo.png') }}" alt="Logo">
            </td>
            <td style="text-align:right;">
                <div style="display: inline-block; text-align: center;">
                    <img class="armoirie" src="{{ public_path('img/armoirie.png') }}" alt="Armoirie">
                    <p style="font-style: italic; margin: 0; font-size:12px">
                        République de Côte d'Ivoire <br> Union - Discipline - Travail
                    </p>
                </div>
            </td>
        </tr>
    </table>


    @yield('content')

    <div class="footer">
        <hr>
        <p>le Conseil Café-Cacao - Organisme créé par Ordonnance N°2011-481 du 28 décembre 20211 <br> Immeuble CAISTAB
            23eme étage - Tél: (+225) 2720256969/ 2720256970 - 17 BP 797 ABIDJAN 17 <br> www.conseilcafecacao.ci
        </p>
    </div>
</body>
</html>
