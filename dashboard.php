<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.html');
    exit();
}
require_once 'database.php';

// Fetch statistics
$stats = [
    'total_feedback' => $pdo->query("SELECT COUNT(*) FROM feedback")->fetchColumn(),
    'avg_formation' => $pdo->query("SELECT AVG(CASE formation 
        WHEN 'excellent' THEN 4 
        WHEN 'bon' THEN 3 
        WHEN 'moyenne' THEN 2 
        WHEN 'insatisfaisant' THEN 1 
        END) FROM feedback")->fetchColumn(),
    'recent_feedback' => $pdo->query("SELECT COUNT(*) FROM feedback WHERE date_creation >= DATE_SUB(NOW(), INTERVAL 7 DAY)")->fetchColumn()
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- ... existing head content ... -->
</head>
<body>
    <!-- ... existing header ... -->

    <main class="dashboard-container">
        <h1><i class="fas fa-tachometer-alt"></i> Tableau de bord administrateur</h1>
        
        <div class="dashboard-stats">
            <div class="stat-card">
                <i class="fas fa-comments"></i>
                <h3>Total Feedbacks</h3>
                <div class="stat-number"><?php echo $stats['total_feedback']; ?></div>
            </div>
            
            <div class="stat-card">
                <i class="fas fa-star"></i>
                <h3>Note Moyenne Formation</h3>
                <div class="stat-number"><?php echo number_format($stats['avg_formation'], 1); ?>/4</div>
            </div>
            
            <div class="stat-card">
                <i class="fas fa-clock"></i>
                <h3>Feedbacks Récents</h3>
                <div class="stat-number"><?php echo $stats['recent_feedback']; ?></div>
            </div>
        </div>

        <div class="recent-feedback">
            <h2><i class="fas fa-history"></i> Feedbacks Récents</h2>
            <div class="feedback-list">
                <?php
                $recent = $pdo->query("SELECT * FROM feedback ORDER BY date_creation DESC LIMIT 5");
                while ($feedback = $recent->fetch()) {
                    echo '<div class="feedback-item">';
                    echo '<div class="feedback-header">';
                    echo '<span class="date">'.date('d/m/Y H:i', strtotime($feedback['date_creation'])).'</span>';
                    echo '</div>';
                    echo '<div class="feedback-content">';
                    echo '<p><strong>Formation:</strong> '.$feedback['formation'].'</p>';
                    echo '<p><strong>Enseignant:</strong> '.$feedback['enseignant'].'</p>';
                    echo '<p><strong>Infrastructure:</strong> '.$feedback['infrastructure'].'</p>';
                    if ($feedback['commentaire']) {
                        echo '<p><strong>Commentaire:</strong> '.$feedback['commentaire'].'</p>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </main>

    <!-- ... existing footer ... -->
</body>
</html>