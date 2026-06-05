<?php 
session_start();
if(!isset($_SESSION['user'])){
    header("Location: index.html");
    exit();
}
require("connex.php");
$idcom = connexobjet("school", "myparam");
$result = $idcom->query("SELECT * FROM client ORDER BY id_client DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des clients</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #fff8f3;
            padding: 25px;
            color: #2c3e50;
        }
        
        .page-container {
            max-width: 1100px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 25px rgba(255, 102, 0, 0.15);
            overflow: hidden;
            border: 3px solid #ff6600;
        }
        
        .page-header {
            background: linear-gradient(90deg, #ff6600 0%, #ff8533 100%);
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-header h1 {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            text-transform: uppercase;
        }
        
        .page-header .btn {
            background: white;
            color: #ff6600;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }
        
        .page-header .btn:hover {
            background: #2c3e50;
            color: white;
        }
        
        .table-container {
            padding: 30px;
            overflow-x: auto;
        }
        
        .table-users {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }
        
        .table-users thead {
            background: #ff6600;
            color: white;
        }
        
        .table-users th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }
        
        .table-users td {
            padding: 14px 15px;
            border-bottom: 1px solid #ffe5d6;
        }
        
        .table-users tbody tr:hover {
            background: #fff5f0;
        }
        
        .table-users tbody tr:nth-child(even) {
            background: #fdfdfd;
        }
        
        .email {
            color: #ff6600;
            font-weight: 600;
        }
        
        .tel {
            font-weight: 600;
        }
        
        .back-link {
            display: inline-block;
            margin: 0 30px 25px 30px;
            color: #ff6600;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
        }
        
        .back-link::before { content: '← '; }
    </style>
</head>
<body>

<div class="page-container">
    <div class="page-header">
        <h1>Liste des clients</h1>
        <a href="client.html" class="btn">+ Ajouter client</a>
    </div>

    <div class="table-container">
        <table class="table-users">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Ville</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo $row['id_client']; ?></td>
                    <td><strong><?php echo $row['nom']; ?></strong></td>
                    <td><?php echo $row['prenom']; ?></td>
                    <td class="email"><?php echo $row['mail']; ?></td>
                    <td><?php echo $row['ville']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <a href="accueil.php" class="back-link">Retour à l'accueil</a>
</div>

</body>
</html>