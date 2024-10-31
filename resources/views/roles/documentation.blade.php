@extends('layouts.app')

@section('content')
<style>

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f4f4f4;
    }
</style>
<div class="container">
    <h1>Rôles et Permissions</h1>

    <h2>Rôles Courants</h2>
    <ul>
        <li>
            <strong>Administrateur</strong>
            <ul>
                <li><strong>Permissions :</strong></li>
                <li>Gérer les utilisateurs (ajouter, modifier, supprimer)</li>
                <li>Gérer les rôles et permissions</li>
                <li>Accéder à toutes les sections de l'application</li>
                <li>Configurer les paramètres de l'application</li>
            </ul>
        </li>
        <li>
            <strong>Modérateur</strong>
            <ul>
                <li><strong>Permissions :</strong></li>
                <li>Gérer le contenu (modifier, approuver, supprimer)</li>
                <li>Gérer les commentaires et les rapports d'utilisateurs</li>
                <li>Accéder aux rapports d'activité</li>
            </ul>
        </li>
        <li>
            <strong>Utilisateur</strong>
            <ul>
                <li><strong>Permissions :</strong></li>
                <li>Créer et modifier son propre profil</li>
                <li>Publier du contenu (articles, commentaires)</li>
                <li>Accéder aux fonctionnalités de base de l'application</li>
            </ul>
        </li>
        <li>
            <strong>Visiteur</strong>
            <ul>
                <li><strong>Permissions :</strong></li>
                <li>Accéder à des sections publiques de l'application</li>
                <li>Consulter le contenu sans pouvoir interagir (ex. : commenter)</li>
            </ul>
        </li>
        <li>
            <strong>Éditeur</strong>
            <ul>
                <li><strong>Permissions :</strong></li>
                <li>Gérer le contenu (ajouter, modifier, supprimer)</li>
                <li>Approuver le contenu soumis par d'autres utilisateurs</li>
            </ul>
        </li>
    </ul>

    <h2>Permissions Typiques</h2>
    <ul>
        <li><strong>Lecture (View)</strong> : Permission de voir ou de lire des données.</li>
        <li><strong>Écriture (Create)</strong> : Permission d'ajouter de nouvelles données.</li>
        <li><strong>Modification (Update)</strong> : Permission de modifier des données existantes.</li>
        <li><strong>Suppression (Delete)</strong> : Permission de supprimer des données.</li>
        <li><strong>Gestion des utilisateurs</strong> : Permission de créer, modifier ou supprimer des comptes utilisateurs.</li>
        <li><strong>Gestion des rôles</strong> : Permission de créer ou modifier des rôles et leurs permissions.</li>
    </ul>

    <h2>Exemple de Matrice Rôles/Permissions</h2>
    <table>
        <tr>
            <th>Rôle</th>
            <th>Lecture</th>
            <th>Écriture</th>
            <th>Modification</th>
            <th>Suppression</th>
            <th>Gestion des utilisateurs</th>
            <th>Gestion des rôles</th>
        </tr>
        <tr>
            <td>Administrateur</td>
            <td>Oui</td>
            <td>Oui</td>
            <td>Oui</td>
            <td>Oui</td>
            <td>Oui</td>
            <td>Oui</td>
        </tr>
        <tr>
            <td>Modérateur</td>
            <td>Oui</td>
            <td>Non</td>
            <td>Oui</td>
            <td>Oui</td>
            <td>Non</td>
            <td>Non</td>
        </tr>
        <tr>
            <td>Utilisateur</td>
            <td>Oui</td>
            <td>Oui</td>
            <td>Oui</td>
            <td>Non</td>
            <td>Non</td>
            <td>Non</td>
        </tr>
        <tr>
            <td>Visiteur</td>
            <td>Oui</td>
            <td>Non</td>
            <td>Non</td>
            <td>Non</td>
            <td>Non</td>
            <td>Non</td>
        </tr>
        <tr>
            <td>Éditeur</td>
            <td>Oui</td>
            <td>Oui</td>
            <td>Oui</td>
            <td>Oui</td>
            <td>Non</td>
            <td>Non</td>
        </tr>
    </table>


</div>

@endsection



