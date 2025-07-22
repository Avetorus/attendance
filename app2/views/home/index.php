<?php foreach($data["allAdmin"] as $admin): ?>
    <p><?= $admin["admin_name"]; ?></p>
<?php endforeach; ?>

<?php 
echo"<pre>";
echo print_r($data["admin"]);
echo"</pre>";




