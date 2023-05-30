<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'get') {
        //čtení z databáze

        foreach ($messages as $message) {
            echo '<div class="chat-message w-75 mt-2">';
                echo '<div class="message-info d-flex align-items-center">';
                    echo '<img src="assets/img/foxpfp.jpg" class="profile-pic" alt="">';
                    echo '<h3>Placeholder <span>Datum</span></h3>';
                echo '</div>';
                echo '<div class="message-content ml-5">';
                    echo "<p class='ml-5'>$message</p>";
                echo '</div>';
            echo '</div>';
        }
    } elseif ($_POST['action'] === 'send' && isset($_POST['message'])) {
        $message = $_POST['message'];

        //uložení do databáze
    }
}