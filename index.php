<?php
require_once __DIR__ . '/vendor/autoload.php';

use Helpers\RandomGenerator;
use Users\User;
use Users\Employee;

// クエリ文字列からパラメータを取得
$min = $_GET['min'] ?? 5;
$max = $_GET['max'] ?? 20;

// パラメータが整数であることを確認
$min = (int)$min;
$max = (int)$max;

// ユーザーの生成
$users = RandomGenerator::users($min, $max);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profiles</title>
        <style>
            /* ユーザーカードのスタイル */
        </style>
    </head>
    <body>
        <h1>User Profiles</h1>

        <?php foreach ($users as $user): ?>
        <div class="user-card">
            <!-- ユーザー情報の表示 -->
            <?= $user->toHTML(); ?>
        </div>
        <?php endforeach; ?>

    </body>
</html>