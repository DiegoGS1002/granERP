<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            // ── Geral ──────────────────────────────────────
            ['key' => 'system_name',    'value' => 'Nexora ERP',     'group' => 'general'],
            ['key' => 'system_slogan',  'value' => 'Gestão Inteligente para Empresas Modernas', 'group' => 'general'],
            ['key' => 'timezone',       'value' => 'America/Sao_Paulo', 'group' => 'general'],
            ['key' => 'language',       'value' => 'pt_BR',          'group' => 'general'],
            ['key' => 'date_format',    'value' => 'd/m/Y',          'group' => 'general'],
            ['key' => 'time_format',    'value' => '24h',            'group' => 'general'],

            // ── Empresa ─────────────────────────────────────
            ['key' => 'company_name',    'value' => '',  'group' => 'company'],
            ['key' => 'company_fantasy', 'value' => '',  'group' => 'company'],
            ['key' => 'company_cnpj',    'value' => '',  'group' => 'company'],
            ['key' => 'company_ie',      'value' => '',  'group' => 'company'],
            ['key' => 'company_address', 'value' => '',  'group' => 'company'],
            ['key' => 'company_number',  'value' => '',  'group' => 'company'],
            ['key' => 'company_city',    'value' => '',  'group' => 'company'],
            ['key' => 'company_state',   'value' => 'SP', 'group' => 'company'],
            ['key' => 'company_zipcode', 'value' => '',  'group' => 'company'],
            ['key' => 'company_email',   'value' => '',  'group' => 'company'],
            ['key' => 'company_phone',   'value' => '',  'group' => 'company'],

            // ── Financeiro ───────────────────────────────────
            ['key' => 'currency',           'value' => 'BRL',  'group' => 'financial'],
            ['key' => 'decimal_separator',  'value' => ',',    'group' => 'financial'],
            ['key' => 'thousand_separator', 'value' => '.',    'group' => 'financial'],
            ['key' => 'default_tax',        'value' => '0',    'group' => 'financial'],

            // ── Notificações ─────────────────────────────────
            ['key' => 'notify_low_stock',      'value' => '1', 'group' => 'notifications'],
            ['key' => 'notify_welcome_email',  'value' => '1', 'group' => 'notifications'],
            ['key' => 'notify_browser',        'value' => '1', 'group' => 'notifications'],
            ['key' => 'whatsapp_api_key',      'value' => '',  'group' => 'notifications'],

            // ── Aparência ────────────────────────────────────
            ['key' => 'theme',            'value' => 'light',       'group' => 'appearance'],
            ['key' => 'primary_color',    'value' => 'blue',        'group' => 'appearance'],
            ['key' => 'ui_density',       'value' => 'comfortable', 'group' => 'appearance'],
            ['key' => 'sidebar_default',  'value' => 'expanded',    'group' => 'appearance'],

            // ── Segurança ────────────────────────────────────
            ['key' => 'session_timeout',   'value' => '120',  'group' => 'security'],
            ['key' => 'password_strength', 'value' => '1',    'group' => 'security'],
            ['key' => 'maintenance_mode',  'value' => '0',    'group' => 'security'],
            ['key' => 'activity_log',      'value' => '1',    'group' => 'security'],

            // ── Regras de Estoque ─────────────────────────
            ['key' => 'allow_sale_no_stock',     'value' => 'nao',      'group' => 'stock'],
            ['key' => 'stock_reserve_moment',    'value' => 'nota',     'group' => 'stock'],
            ['key' => 'critical_stock_percent',  'value' => '10',       'group' => 'stock'],

            // ── Regras Fiscais ────────────────────────────
            ['key' => 'default_cfop',            'value' => '5102',         'group' => 'fiscal'],
            ['key' => 'auto_emit_nfe',           'value' => '0',            'group' => 'fiscal'],
            ['key' => 'emission_environment',    'value' => 'homologacao',  'group' => 'fiscal'],
            ['key' => 'realtime_tax_calc',       'value' => '0',            'group' => 'fiscal'],

            // ── Regras Gerenciais / Vendas ────────────────
            ['key' => 'allow_negative_margin',   'value' => '0',        'group' => 'sales'],
            ['key' => 'max_discount_percent',    'value' => '5',        'group' => 'sales'],
            ['key' => 'active_price_table',      'value' => 'varejo',   'group' => 'sales'],
            ['key' => 'quote_validity_days',     'value' => '7',        'group' => 'sales'],
            ['key' => 'sale_type',               'value' => 'hibrido',  'group' => 'sales'],
            ['key' => 'require_cpf_on_note',     'value' => '0',        'group' => 'sales'],
        ];

        foreach ($defaults as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'group' => $setting['group']]
            );
        }
    }
}

