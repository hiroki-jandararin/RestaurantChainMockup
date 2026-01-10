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
$chains = RandomGenerator::restaurantChains($min, $max);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Restaurant Chain</h1>
            <div class="card mb-4">
            <div class="card-header fw-bold">
                Restaurant Chain Information
            </div>
            <div class="card-body">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Company Name
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>Company Name: Company Name</strong> It is shown by default.
                        </div>
                        <div class="accordion-body">
                            <strong>Employees:</strong>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Birth Date</th>
                                        <th scope="col">Membership Expiration</th>
                                        <th scope="col">Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <?php $u = $user->toArray(); ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars((string)($u['id'] ?? '')); ?></td>
                                            <td><?php echo htmlspecialchars(trim(($u['firstName'] ?? '') . ' ' . ($u['lastName'] ?? ''))); ?></td>
                                            <td><?php echo htmlspecialchars((string)($u['email'] ?? '')); ?></td>
                                            <td><?php echo htmlspecialchars((string)($u['phoneNumber'] ?? '')); ?></td>
                                            <td><?php echo htmlspecialchars((string)($u['address'] ?? '')); ?></td>
                                            <td><?php echo htmlspecialchars(($u['birthDate'] instanceof DateTime ? $u['birthDate']->format('Y-m-d') : (string)($u['birthDate'] ?? ''))); ?></td>
                                            <td><?php echo htmlspecialchars(($u['membershipExpirationDate'] instanceof DateTime ? $u['membershipExpirationDate']->format('Y-m-d') : (string)($u['membershipExpirationDate'] ?? ''))); ?></td>
                                            <td><?php echo htmlspecialchars((string)($u['role'] ?? '')); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>