<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=databasemessages;charset=utf8', 
    'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

$stmtGet='SELECT DISTINCT * FROM `messagestable` ORDER BY id ASC LIMIT 50';
$queryGet = $bdd->query($stmtGet);
$messages = $queryGet->fetchAll();
foreach ($messages as $msg) {
?>
    <div class="messageField">
        <p id="nameSession">
            <?= $msg['pseudo'] ?>
        </p>
        <p id="message">
            <?= $msg['msg'] ?>
        </p>
    </div>
    <?php
    }
        
        
        /*while($msg=$queryGet->fetch()){
            $nameData=$msg['pseudo'];
            $messageData=$msg['msg'];?>
            <p id="nameSession">
                <?=$nameData?>
            </p>
            <p id="message">
                <?=$messageData?>     
            </p>
            <?php }*/