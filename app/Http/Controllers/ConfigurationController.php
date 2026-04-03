<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ConfigurationController extends Controller
{
    /* ─────────────────────────────────────────
     | Exibe a página de configurações
     ───────────────────────────────────────── */
    public function index()
    {
        try {
            $settings = Setting::allKeyed();
        } catch (\Throwable $e) {
            // A tabela settings ainda não existe (migrate pendente)
            $settings = [];
        }

        return view('admin.settings.index', compact('settings'));
    }

    /* ─────────────────────────────────────────
     | Salva todas as configurações
     ───────────────────────────────────────── */
    public function store(Request $request)
    {
        $request->validate([
            'system_name'         => 'required|string|max:100',
            'system_slogan'       => 'nullable|string|max:255',
            'timezone'            => 'required|string',
            'language'            => 'required|string',
            'date_format'         => 'required|string',
            'time_format'         => 'required|string',

            'company_name'        => 'nullable|string|max:255',
            'company_fantasy'     => 'nullable|string|max:255',
            'company_cnpj'        => 'nullable|string|max:18',
            'company_ie'          => 'nullable|string|max:30',
            'company_address'     => 'nullable|string|max:255',
            'company_number'      => 'nullable|string|max:20',
            'company_city'        => 'nullable|string|max:100',
            'company_state'       => 'nullable|string|max:2',
            'company_zipcode'     => 'nullable|string|max:10',
            'company_email'       => 'nullable|email|max:150',
            'company_phone'       => 'nullable|string|max:20',

            'currency'            => 'required|string',
            'decimal_separator'   => 'required|string',
            'thousand_separator'  => 'required|string',
            'default_tax'         => 'nullable|numeric|min:0|max:100',

            'theme'               => 'required|in:light,dark,system',
            'primary_color'       => 'required|string',
            'ui_density'          => 'required|in:comfortable,compact',
            'sidebar_default'     => 'required|in:expanded,collapsed',

            'session_timeout'     => 'required|integer',
            'whatsapp_api_key'    => 'nullable|string|max:255',

            // Estoque
            'allow_sale_no_stock'    => 'required|in:sim,nao,autorizar',
            'stock_reserve_moment'   => 'required|in:pedido,nota',
            'critical_stock_percent' => 'nullable|integer|min:0|max:100',

            // Fiscal
            'default_cfop'           => 'nullable|string|max:10',
            'emission_environment'   => 'required|in:homologacao,producao',

            // Vendas
            'max_discount_percent'   => 'nullable|numeric|min:0|max:100',
            'active_price_table'     => 'required|in:varejo,atacado,promocional',
            'quote_validity_days'    => 'nullable|integer|min:1|max:365',
            'sale_type'              => 'required|in:gerencial,fiscal,hibrido',
        ]);

        $groups = [
            'general'       => ['system_name','system_slogan','timezone','language','date_format','time_format'],
            'company'       => ['company_name','company_fantasy','company_cnpj','company_ie','company_address','company_number','company_city','company_state','company_zipcode','company_email','company_phone'],
            'financial'     => ['currency','decimal_separator','thousand_separator','default_tax'],
            'notifications' => ['notify_low_stock','notify_welcome_email','notify_browser','whatsapp_api_key'],
            'appearance'    => ['theme','primary_color','ui_density','sidebar_default'],
            'security'      => ['session_timeout','password_strength','maintenance_mode','activity_log'],
            'stock'         => ['allow_sale_no_stock','stock_reserve_moment','critical_stock_percent'],
            'fiscal'        => ['default_cfop','auto_emit_nfe','emission_environment','realtime_tax_calc'],
            'sales'         => ['allow_negative_margin','max_discount_percent','active_price_table','quote_validity_days','sale_type','require_cpf_on_note'],
        ];

        foreach ($groups as $group => $keys) {
            foreach ($keys as $key) {
                // Toggles/checkboxes: se não vier no request, assume '0'
                $toggles = [
                    'notify_low_stock','notify_welcome_email','notify_browser',
                    'password_strength','maintenance_mode','activity_log',
                    'auto_emit_nfe','realtime_tax_calc',
                    'allow_negative_margin','require_cpf_on_note',
                ];
                $value = in_array($key, $toggles)
                    ? ($request->boolean($key) ? '1' : '0')
                    : $request->input($key, '');

                Setting::set($key, $value, $group);
            }
        }

        // Invalida todo o cache de configurações
        Cache::flush();

        return redirect()
            ->route('configuration.index')
            ->with('success', 'Configurações salvas com sucesso!');
    }
}
