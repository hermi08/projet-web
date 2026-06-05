<?php 
session_start();
require("connex.php");
$idcom = connexobjet("school", "myparam");
$result = $idcom->query("SELECT * FROM article ORDER BY designation ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Choisir un article</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #fff8f3; padding: 20px; }
        .container { background: white; border-radius: 10px; border: 3px solid #ff6600; overflow: hidden; }
        .header { background: linear-gradient(90deg, #ff6600 0%, #ff8533 100%); color: white; padding: 15px; text-align: center; }
        .header h2 { margin: 0; font-size: 20px; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        thead { background: #ff6600; color: white; }
        th { padding: 12px 10px; text-align: left; font-weight: 600; text-transform: uppercase; font-size: 12px; }
        td { padding: 10px; border-bottom: 1px solid #ffe5d6; }
        tbody tr:hover { background: #fff5f0; cursor: pointer; }
        .prix { font-weight: 700; color: #ff6600; }
        .btn-choisir {
            background: #ff6600; color: white; border: none; padding: 6px 14px;
            border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 13px;
        }
        .btn-choisir:hover { background: #e55a00; }
        .badge { padding: 3px 8px; border-radius: 10px; font-size: 11px; font-weight: 700; }
        .badge-a { background: #e8f5e9; color: #2e7d32; }
        .badge-b { background: #fff3e0; color: #e65100; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Choisir un article</h2>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Désignation</th>
                <th>Prix</th>
                <th>Catégorie</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $row['id_article']; ?></td>
                <td><strong><?php echo $row['designation']; ?></strong></td>
                <td class="prix"><?php echo number_format($row['prix'], 0, ',', ' '); ?> FCFA</td>
                <td>
                    <span class="badge badge-<?php echo strtolower($row['categorie']); ?>">
                        <?php echo $row['categorie']; ?>
                    </span>
                </td>
                <td>
                    <button type="button" class="btn-choisir" 
                        onclick="choisirArticle('<?php echo $row['id_article']; ?>', '<?php echo addslashes($row['designation']); ?>')">
                        Choisir
                    </button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
function choisirArticle(id, designation) {
    // On renvoie les infos au formulaire parent vente.php
    window.opener.document.getElementById('id_article').value = id;
    window.opener.document.getElementById('designation').value = designation;
    window.close(); // On ferme le popup
}
</script>

</body>
</html>