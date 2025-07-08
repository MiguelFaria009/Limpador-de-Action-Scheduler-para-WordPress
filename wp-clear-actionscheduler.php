<?php
/**
 * Plugin Name: Limpador de Action Scheduler
 * Description: Remove ações e logs do Action Scheduler automaticamente a cada 3 dias, com painel para execução manual e otimização automática.
 * Version: 1.3
 * Author: Miguel Faria
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Agendamento a cada 3 dias
register_activation_hook(__FILE__, function() {
    if ( ! wp_next_scheduled( 'limpar_actionscheduler_3dias' ) ) {
        wp_schedule_event( time(), 'cada_3_dias', 'limpar_actionscheduler_3dias' );
    }
});

register_deactivation_hook(__FILE__, function() {
    wp_clear_scheduled_hook( 'limpar_actionscheduler_3dias' );
});

// Define o intervalo de 3 dias
add_filter( 'cron_schedules', function( $schedules ) {
    $schedules['cada_3_dias'] = array(
        'interval' => 3 * 24 * 60 * 60, // 259200 segundos
        'display'  => __( 'A cada 3 dias' )
    );
    return $schedules;
});

// Função principal de limpeza + otimização
function limpar_action_scheduler_completo() {
    global $wpdb;

    $wpdb->query("DELETE FROM {$wpdb->prefix}actionscheduler_logs");
    $wpdb->query("DELETE FROM {$wpdb->prefix}actionscheduler_actions");

    $wpdb->query("OPTIMIZE TABLE {$wpdb->prefix}actionscheduler_logs");
    $wpdb->query("OPTIMIZE TABLE {$wpdb->prefix}actionscheduler_actions");

    update_option('ultima_execucao_action_scheduler', current_time('mysql'));
}

// Hook do cron
add_action('limpar_actionscheduler_3dias', 'limpar_action_scheduler_completo');

// Painel administrativo
add_action('admin_menu', function() {
    add_submenu_page(
        'tools.php',
        'Limpador Action Scheduler',
        'Limpador Action Scheduler',
        'manage_options',
        'limpador-action-scheduler',
        'painel_limpador_action_scheduler'
    );
});

// Interface do painel
function painel_limpador_action_scheduler() {
    if ( isset($_POST['executar_limpeza']) && check_admin_referer('limpar_asagora') ) {
        limpar_action_scheduler_completo();
        echo '<div class="updated"><p>Limpeza executada com sucesso!</p></div>';
    }

    $ultima = get_option('ultima_execucao_action_scheduler');
    ?>
    <div class="wrap">
        <h1>Limpador Action Scheduler</h1>
        <p><strong>Última limpeza executada:</strong> <?php echo $ultima ? esc_html($ultima) : 'Nunca'; ?></p>
        <form method="post">
            <?php wp_nonce_field('limpar_asagora'); ?>
            <input type="submit" name="executar_limpeza" class="button button-primary" value="Executar Limpeza Agora">
        </form>
        <p style="margin-top:15px; color:#666;">A limpeza é feita automaticamente a cada 3 dias e inclui otimização das tabelas para liberar espaço em disco.</p>
    </div>
    <?php
}
