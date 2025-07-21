<?php foreach ($data["UserModel"] as $user): ?>
    <p><?= $user["name"] ?></p>
    <p><?= $user["position"] ?></p>
    <hr>
<?php endforeach; ?>