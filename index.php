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

$users = RandomGenerator::users(1, 3);
$chains = RandomGenerator::restaurantChains(1, 3);
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
                    <?php foreach ($chains as $idx => $chain): ?>
                        <?php
                            $collapseId = 'collapseChain' . $idx;
                            $headingId  = 'headingChain' . $idx;
                            $isFirst = ($idx === 0);
                            $companyName = method_exists($chain, 'getName') ? (string)$chain->getName() : ('Company #' . ($idx + 1));
                        ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?php echo htmlspecialchars($headingId); ?>">
                                <button class="accordion-button <?php echo $isFirst ? '' : 'collapsed'; ?>" type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#<?php echo htmlspecialchars($collapseId); ?>"
                                    aria-expanded="<?php echo $isFirst ? 'true' : 'false'; ?>"
                                    aria-controls="<?php echo htmlspecialchars($collapseId); ?>">
                                    <?php echo htmlspecialchars($companyName); ?>
                                </button>
                            </h2>
                            <div id="<?php echo htmlspecialchars($collapseId); ?>" class="accordion-collapse collapse <?php echo $isFirst ? 'show' : ''; ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>Company Name:</strong> <?php echo htmlspecialchars($companyName); ?>
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
                                                <?php
                                                    $chainEmployees = [];

                                                    if (method_exists($chain, 'getLocations')) {
                                                        $locations = $chain->getLocations();
                                                        if (is_array($locations)) {
                                                            foreach ($locations as $loc) {
                                                                if (is_object($loc) && method_exists($loc, 'getEmployees')) {
                                                                    $emps = $loc->getEmployees();
                                                                    if (is_array($emps)) {
                                                                        foreach ($emps as $emp) {
                                                                            $chainEmployees[] = $emp;
                                                                        }
                                                                    }
                                                                } elseif (is_object($loc) && method_exists($loc, 'toArray')) {
                                                                    $la = $loc->toArray();
                                                                    if (!empty($la['employees']) && is_array($la['employees'])) {
                                                                        foreach ($la['employees'] as $emp) {
                                                                            $chainEmployees[] = $emp;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    } elseif (method_exists($chain, 'toArray')) {
                                                        $ca = $chain->toArray();
                                                        if (!empty($ca['locations']) && is_array($ca['locations'])) {
                                                            foreach ($ca['locations'] as $loc) {
                                                                if (is_object($loc) && method_exists($loc, 'getEmployees')) {
                                                                    $emps = $loc->getEmployees();
                                                                    if (is_array($emps)) {
                                                                        foreach ($emps as $emp) {
                                                                            $chainEmployees[] = $emp;
                                                                        }
                                                                    }
                                                                } elseif (is_array($loc) && !empty($loc['employees']) && is_array($loc['employees'])) {
                                                                    foreach ($loc['employees'] as $emp) {
                                                                        $chainEmployees[] = $emp;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }

                                                    if (empty($chainEmployees)) {
                                                        echo '<tr><td colspan="8" class="text-muted">No employees found for this chain.</td></tr>';
                                                    }
                                                ?>

                                                <?php foreach ($chainEmployees as $emp): ?>
                                                    <?php
                                                        $u = is_object($emp) && method_exists($emp, 'toArray') ? $emp->toArray() : (is_array($emp) ? $emp : []);
                                                    ?>
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
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>