<!-- views/admin_dashboard.php -->
<h1>Tableau de bord Administrateur</h1>
<a href="logout.php">Se déconnecter</a>
<h2>Liste des utilisateurs</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Rôle</th>
        <th>Action</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['role'] ?></td>
            <td><a href="edit_user.php?id=<?= $user['id'] ?>">Éditer</a></td>
        </tr>
    <?php endforeach; ?>
</table>
