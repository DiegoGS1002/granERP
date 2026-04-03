@extends('layouts.app')

@section('title', 'Configurações do Sistema')

@section('content')
<div class="nx-list-page">

    {{-- ── HEADER ── --}}
    <div class="nx-page-header">
        <div class="nx-page-header-left">
            <h1 class="nx-page-title">Configurações do Sistema</h1>
            <p class="nx-page-subtitle">Personalize o comportamento, identidade e segurança do Nexora ERP</p>
        </div>
    </div>

    {{-- ── LAYOUT PRINCIPAL ── --}}
    <form method="POST" action="{{ route('configuration.store') }}" id="settings-form">
        @csrf

        <div class="nx-settings-layout">

            {{-- ─────────────────────────────────
                 SIDEBAR DE NAVEGAÇÃO
                 ───────────────────────────────── --}}
            <nav class="nx-settings-nav" aria-label="Seções de configuração">

                <button type="button" class="nx-settings-nav-item active" data-tab="geral">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>
                    </svg>
                    Geral
                </button>

                <button type="button" class="nx-settings-nav-item" data-tab="empresa">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Empresa
                </button>

                <button type="button" class="nx-settings-nav-item" data-tab="financeiro">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"/>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                    </svg>
                    Financeiro
                </button>

                <button type="button" class="nx-settings-nav-item" data-tab="notificacoes">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
                    Notificações
                </button>

                <div class="nx-settings-nav-divider"></div>

                <button type="button" class="nx-settings-nav-item" data-tab="aparencia">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/>
                        <path d="M2 12h20"/>
                    </svg>
                    Aparência
                </button>

                <button type="button" class="nx-settings-nav-item" data-tab="seguranca">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                    Segurança
                </button>

                <div class="nx-settings-nav-divider"></div>

                <button type="button" class="nx-settings-nav-item" data-tab="estoque">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                        <path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/>
                    </svg>
                    Regras de Estoque
                </button>

                <button type="button" class="nx-settings-nav-item" data-tab="fiscal-config">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                    Regras Fiscais
                </button>

                <button type="button" class="nx-settings-nav-item" data-tab="vendas-config">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                    </svg>
                    Regras de Venda
                </button>

            </nav>

            {{-- ─────────────────────────────────
                 CONTEÚDO DAS ABAS
                 ───────────────────────────────── --}}
            <div class="nx-settings-panels">

                {{-- ┌─────────────────────────────┐
                     │  ABA: GERAL                  │
                     └─────────────────────────────┘ --}}
                <div class="nx-settings-content active nx-form-card" id="tab-geral">

                    <div class="nx-settings-section-header">
                        <div class="nx-settings-section-icon" style="background:rgba(59,130,246,.1);color:#3B82F6;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="3"/>
                                <path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>
                            </svg>
                        </div>
                        <div class="nx-settings-section-text">
                            <p class="nx-settings-section-title">Configurações Gerais</p>
                            <p class="nx-settings-section-desc">Identidade e funcionamento básico do sistema</p>
                        </div>
                    </div>

                    <div class="nx-settings-body">

                        {{-- Nome e Slogan --}}
                        <div class="nx-settings-row">
                            <div class="nx-field">
                                <label for="system_name">Nome do Sistema</label>
                                <input type="text" id="system_name" name="system_name"
                                       value="{{ old('system_name', $settings['system_name'] ?? 'Nexora ERP') }}"
                                       placeholder="Nexora ERP">
                                <small>Nome exibido no título das páginas e no cabeçalho.</small>
                                @error('system_name')<small style="color:#EF4444;">{{ $message }}</small>@enderror
                            </div>
                            <div class="nx-field">
                                <label for="system_slogan">Slogan / Subtítulo</label>
                                <input type="text" id="system_slogan" name="system_slogan"
                                       value="{{ old('system_slogan', $settings['system_slogan'] ?? '') }}"
                                       placeholder="Gestão Inteligente para Empresas Modernas">
                                <small>Texto exibido abaixo do logo ou no dashboard.</small>
                            </div>
                        </div>

                        {{-- Fuso e Idioma --}}
                        <div class="nx-settings-row">
                            <div class="nx-field">
                                <label for="timezone">Fuso Horário</label>
                                <select id="timezone" name="timezone">
                                    @php $tz = old('timezone', $settings['timezone'] ?? 'America/Sao_Paulo'); @endphp
                                    <option value="America/Sao_Paulo"    {{ $tz === 'America/Sao_Paulo'    ? 'selected' : '' }}>América/São Paulo (UTC-3)</option>
                                    <option value="America/Manaus"       {{ $tz === 'America/Manaus'       ? 'selected' : '' }}>América/Manaus (UTC-4)</option>
                                    <option value="America/Belem"        {{ $tz === 'America/Belem'        ? 'selected' : '' }}>América/Belém (UTC-3)</option>
                                    <option value="America/Fortaleza"    {{ $tz === 'America/Fortaleza'    ? 'selected' : '' }}>América/Fortaleza (UTC-3)</option>
                                    <option value="America/Recife"       {{ $tz === 'America/Recife'       ? 'selected' : '' }}>América/Recife (UTC-3)</option>
                                    <option value="America/Noronha"      {{ $tz === 'America/Noronha'      ? 'selected' : '' }}>América/Noronha (UTC-2)</option>
                                    <option value="America/Rio_Branco"   {{ $tz === 'America/Rio_Branco'   ? 'selected' : '' }}>América/Rio Branco (UTC-5)</option>
                                    <option value="UTC"                  {{ $tz === 'UTC'                  ? 'selected' : '' }}>UTC</option>
                                </select>
                                <small>Usado nos logs de auditoria e documentos fiscais.</small>
                            </div>
                            <div class="nx-field">
                                <label for="language">Idioma do Sistema</label>
                                <select id="language" name="language">
                                    @php $lang = old('language', $settings['language'] ?? 'pt_BR'); @endphp
                                    <option value="pt_BR" {{ $lang === 'pt_BR' ? 'selected' : '' }}>🇧🇷 Português (Brasil)</option>
                                    <option value="en_US" {{ $lang === 'en_US' ? 'selected' : '' }}>🇺🇸 English (US)</option>
                                    <option value="es_ES" {{ $lang === 'es_ES' ? 'selected' : '' }}>🇪🇸 Español</option>
                                </select>
                            </div>
                        </div>

                        {{-- Formatos de data e hora --}}
                        <div class="nx-settings-row">
                            <div class="nx-field">
                                <label for="date_format">Formato de Data</label>
                                <select id="date_format" name="date_format">
                                    @php $df = old('date_format', $settings['date_format'] ?? 'd/m/Y'); @endphp
                                    <option value="d/m/Y"  {{ $df === 'd/m/Y'  ? 'selected' : '' }}>DD/MM/AAAA (ex: 03/04/2026)</option>
                                    <option value="Y-m-d"  {{ $df === 'Y-m-d'  ? 'selected' : '' }}>AAAA-MM-DD (ex: 2026-04-03)</option>
                                    <option value="m/d/Y"  {{ $df === 'm/d/Y'  ? 'selected' : '' }}>MM/DD/AAAA (ex: 04/03/2026)</option>
                                </select>
                            </div>
                            <div class="nx-field">
                                <label for="time_format">Formato de Hora</label>
                                <select id="time_format" name="time_format">
                                    @php $tf = old('time_format', $settings['time_format'] ?? '24h'); @endphp
                                    <option value="24h" {{ $tf === '24h' ? 'selected' : '' }}>24 horas (ex: 14:30)</option>
                                    <option value="12h" {{ $tf === '12h' ? 'selected' : '' }}>12 horas (ex: 02:30 PM)</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="nx-settings-footer">
                        <button type="submit" class="nx-btn nx-btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                <polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                            </svg>
                            Salvar Configurações
                        </button>
                    </div>
                </div>

                {{-- ┌─────────────────────────────┐
                     │  ABA: EMPRESA               │
                     └─────────────────────────────┘ --}}
                <div class="nx-settings-content nx-form-card" id="tab-empresa">

                    <div class="nx-settings-section-header">
                        <div class="nx-settings-section-icon" style="background:rgba(16,185,129,.1);color:#10B981;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                        </div>
                        <div class="nx-settings-section-text">
                            <p class="nx-settings-section-title">Dados da Empresa</p>
                            <p class="nx-settings-section-desc">Informações jurídicas e fiscais utilizadas em documentos</p>
                        </div>
                    </div>

                    <div class="nx-settings-body">

                        {{-- Razão Social e Nome Fantasia --}}
                        <div class="nx-settings-row">
                            <div class="nx-field">
                                <label for="company_name">Razão Social</label>
                                <input type="text" id="company_name" name="company_name"
                                       value="{{ old('company_name', $settings['company_name'] ?? '') }}"
                                       placeholder="Nome completo registrado no CNPJ">
                            </div>
                            <div class="nx-field">
                                <label for="company_fantasy">Nome Fantasia</label>
                                <input type="text" id="company_fantasy" name="company_fantasy"
                                       value="{{ old('company_fantasy', $settings['company_fantasy'] ?? '') }}"
                                       placeholder="Nome comercial da empresa">
                            </div>
                        </div>

                        {{-- CNPJ e Inscrição Estadual --}}
                        <div class="nx-settings-row">
                            <div class="nx-field">
                                <label for="company_cnpj">CNPJ</label>
                                <input type="text" id="company_cnpj" name="company_cnpj"
                                       value="{{ old('company_cnpj', $settings['company_cnpj'] ?? '') }}"
                                       placeholder="00.000.000/0000-00" maxlength="18">
                                <small>Essencial para emissão de documentos fiscais.</small>
                            </div>
                            <div class="nx-field">
                                <label for="company_ie">Inscrição Estadual</label>
                                <input type="text" id="company_ie" name="company_ie"
                                       value="{{ old('company_ie', $settings['company_ie'] ?? '') }}"
                                       placeholder="000.000.000.000">
                            </div>
                        </div>

                        {{-- Endereço --}}
                        <div class="nx-settings-row">
                            <div class="nx-field">
                                <label for="company_address">Logradouro</label>
                                <input type="text" id="company_address" name="company_address"
                                       value="{{ old('company_address', $settings['company_address'] ?? '') }}"
                                       placeholder="Rua, Avenida, etc.">
                            </div>
                            <div class="nx-field">
                                <label for="company_number">Número / Complemento</label>
                                <input type="text" id="company_number" name="company_number"
                                       value="{{ old('company_number', $settings['company_number'] ?? '') }}"
                                       placeholder="123, Sala 10">
                            </div>
                        </div>

                        <div class="nx-settings-row">
                            <div class="nx-field">
                                <label for="company_city">Cidade</label>
                                <input type="text" id="company_city" name="company_city"
                                       value="{{ old('company_city', $settings['company_city'] ?? '') }}"
                                       placeholder="São Paulo">
                            </div>
                            <div class="nx-field">
                                <label for="company_zipcode">CEP</label>
                                <input type="text" id="company_zipcode" name="company_zipcode"
                                       value="{{ old('company_zipcode', $settings['company_zipcode'] ?? '') }}"
                                       placeholder="00000-000" maxlength="10">
                            </div>
                        </div>

                        <div class="nx-settings-row" style="grid-template-columns: 2fr 1fr;">
                            <div class="nx-field">
                                <label for="company_email">E-mail Comercial</label>
                                <input type="email" id="company_email" name="company_email"
                                       value="{{ old('company_email', $settings['company_email'] ?? '') }}"
                                       placeholder="contato@empresa.com.br">
                            </div>
                            <div class="nx-field">
                                <label for="company_phone">Telefone</label>
                                <input type="text" id="company_phone" name="company_phone"
                                       value="{{ old('company_phone', $settings['company_phone'] ?? '') }}"
                                       placeholder="(11) 99999-9999">
                            </div>
                        </div>

                    </div>

                    <div class="nx-settings-footer">
                        <button type="submit" class="nx-btn nx-btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                <polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                            </svg>
                            Salvar Configurações
                        </button>
                    </div>
                </div>

                {{-- ┌─────────────────────────────┐
                     │  ABA: FINANCEIRO            │
                     └─────────────────────────────┘ --}}
                <div class="nx-settings-content nx-form-card" id="tab-financeiro">

                    <div class="nx-settings-section-header">
                        <div class="nx-settings-section-icon" style="background:rgba(245,158,11,.1);color:#F59E0B;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="1" x2="12" y2="23"/>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                            </svg>
                        </div>
                        <div class="nx-settings-section-text">
                            <p class="nx-settings-section-title">Preferências Financeiras</p>
                            <p class="nx-settings-section-desc">Moeda, formatos e alíquotas padrão do sistema</p>
                        </div>
                    </div>

                    <div class="nx-settings-body">

                        <div class="nx-settings-row">
                            <div class="nx-field">
                                <label for="currency">Moeda Padrão</label>
                                <select id="currency" name="currency">
                                    @php $cur = old('currency', $settings['currency'] ?? 'BRL'); @endphp
                                    <option value="BRL" {{ $cur === 'BRL' ? 'selected' : '' }}>🇧🇷 Real Brasileiro (R$)</option>
                                    <option value="USD" {{ $cur === 'USD' ? 'selected' : '' }}>🇺🇸 Dólar Americano (US$)</option>
                                    <option value="EUR" {{ $cur === 'EUR' ? 'selected' : '' }}>🇪🇺 Euro (€)</option>
                                    <option value="ARS" {{ $cur === 'ARS' ? 'selected' : '' }}>🇦🇷 Peso Argentino ($)</option>
                                </select>
                            </div>
                            <div class="nx-field">
                                <label for="default_tax">Alíquota Padrão (%)</label>
                                <input type="number" id="default_tax" name="default_tax"
                                       value="{{ old('default_tax', $settings['default_tax'] ?? '0') }}"
                                       placeholder="0" min="0" max="100" step="0.01">
                                <small>Alíquota usada nos cálculos rápidos de impostos.</small>
                            </div>
                        </div>

                        <div class="nx-settings-row">
                            <div class="nx-field">
                                <label for="decimal_separator">Separador Decimal</label>
                                <select id="decimal_separator" name="decimal_separator">
                                    @php $ds = old('decimal_separator', $settings['decimal_separator'] ?? ','); @endphp
                                    <option value="," {{ $ds === ',' ? 'selected' : '' }}>Vírgula — 1.234,56</option>
                                    <option value="." {{ $ds === '.' ? 'selected' : '' }}>Ponto — 1,234.56</option>
                                </select>
                            </div>
                            <div class="nx-field">
                                <label for="thousand_separator">Separador de Milhares</label>
                                <select id="thousand_separator" name="thousand_separator">
                                    @php $ts = old('thousand_separator', $settings['thousand_separator'] ?? '.'); @endphp
                                    <option value="." {{ $ts === '.' ? 'selected' : '' }}>Ponto — 1.000</option>
                                    <option value="," {{ $ts === ',' ? 'selected' : '' }}>Vírgula — 1,000</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="nx-settings-footer">
                        <button type="submit" class="nx-btn nx-btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                <polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                            </svg>
                            Salvar Configurações
                        </button>
                    </div>
                </div>

                {{-- ┌─────────────────────────────┐
                     │  ABA: NOTIFICAÇÕES          │
                     └─────────────────────────────┘ --}}
                <div class="nx-settings-content nx-form-card" id="tab-notificacoes">

                    <div class="nx-settings-section-header">
                        <div class="nx-settings-section-icon" style="background:rgba(99,102,241,.1);color:#6366F1;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                            </svg>
                        </div>
                        <div class="nx-settings-section-text">
                            <p class="nx-settings-section-title">Notificações e Alertas</p>
                            <p class="nx-settings-section-desc">Controle quando e como o sistema comunica eventos</p>
                        </div>
                    </div>

                    <div class="nx-settings-body">

                        {{-- Alertas de estoque --}}
                        <div class="nx-toggle-row">
                            <div class="nx-toggle-info">
                                <span class="nx-toggle-label">Alertas de Estoque Mínimo</span>
                                <p class="nx-toggle-desc">Notifica quando um produto atingir o nível mínimo de estoque configurado.</p>
                            </div>
                            <label class="nx-switch">
                                <input type="checkbox" name="notify_low_stock" value="1"
                                       {{ old('notify_low_stock', $settings['notify_low_stock'] ?? '1') == '1' ? 'checked' : '' }}>
                                <span class="nx-switch-track"></span>
                            </label>
                        </div>

                        {{-- E-mail de boas-vindas --}}
                        <div class="nx-toggle-row">
                            <div class="nx-toggle-info">
                                <span class="nx-toggle-label">E-mail de Boas-vindas</span>
                                <p class="nx-toggle-desc">Envio automático de e-mail de boas-vindas ao cadastrar novos usuários.</p>
                            </div>
                            <label class="nx-switch">
                                <input type="checkbox" name="notify_welcome_email" value="1"
                                       {{ old('notify_welcome_email', $settings['notify_welcome_email'] ?? '1') == '1' ? 'checked' : '' }}>
                                <span class="nx-switch-track"></span>
                            </label>
                        </div>

                        {{-- Notificações do navegador --}}
                        <div class="nx-toggle-row">
                            <div class="nx-toggle-info">
                                <span class="nx-toggle-label">Notificações no Navegador</span>
                                <p class="nx-toggle-desc">Exibe alertas do sistema diretamente no browser do usuário.</p>
                            </div>
                            <label class="nx-switch">
                                <input type="checkbox" name="notify_browser" value="1"
                                       {{ old('notify_browser', $settings['notify_browser'] ?? '1') == '1' ? 'checked' : '' }}>
                                <span class="nx-switch-track"></span>
                            </label>
                        </div>

                        {{-- WhatsApp API --}}
                        <div class="nx-field" style="margin-top:6px;">
                            <label for="whatsapp_api_key">Chave de API — WhatsApp (opcional)</label>
                            <input type="text" id="whatsapp_api_key" name="whatsapp_api_key"
                                   value="{{ old('whatsapp_api_key', $settings['whatsapp_api_key'] ?? '') }}"
                                   placeholder="Sua chave de API para notificações via WhatsApp">
                            <small>Integração com a API para envio de notificações de vendas e alertas.</small>
                        </div>

                    </div>

                    <div class="nx-settings-footer">
                        <button type="submit" class="nx-btn nx-btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                <polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                            </svg>
                            Salvar Configurações
                        </button>
                    </div>
                </div>

                {{-- ┌─────────────────────────────┐
                     │  ABA: APARÊNCIA             │
                     └─────────────────────────────┘ --}}
                <div class="nx-settings-content nx-form-card" id="tab-aparencia">

                    <div class="nx-settings-section-header">
                        <div class="nx-settings-section-icon" style="background:rgba(236,72,153,.1);color:#EC4899;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/>
                                <path d="M2 12h20"/>
                            </svg>
                        </div>
                        <div class="nx-settings-section-text">
                            <p class="nx-settings-section-title">Aparência e Interface</p>
                            <p class="nx-settings-section-desc">Personalize o visual do sistema para sua empresa</p>
                        </div>
                    </div>

                    <div class="nx-settings-body">

                        {{-- Tema --}}
                        <div class="nx-field">
                            <label style="margin-bottom:12px;">Tema Visual</label>
                            <div class="nx-theme-cards">
                                @php $theme = old('theme', $settings['theme'] ?? 'light'); @endphp

                                <label class="nx-theme-card">
                                    <input type="radio" name="theme" value="light" {{ $theme === 'light' ? 'checked' : '' }}>
                                    <div class="nx-theme-card-inner">
                                        <div class="nx-theme-card-preview" style="background:linear-gradient(135deg,#F8FAFC,#E2E8F0);"></div>
                                        <span class="nx-theme-card-label">☀️ Claro</span>
                                    </div>
                                </label>

                                <label class="nx-theme-card">
                                    <input type="radio" name="theme" value="dark" {{ $theme === 'dark' ? 'checked' : '' }}>
                                    <div class="nx-theme-card-inner">
                                        <div class="nx-theme-card-preview" style="background:linear-gradient(135deg,#0D1B2E,#1E293B);border-color:#334155;"></div>
                                        <span class="nx-theme-card-label">🌙 Escuro</span>
                                    </div>
                                </label>

                                <label class="nx-theme-card">
                                    <input type="radio" name="theme" value="system" {{ $theme === 'system' ? 'checked' : '' }}>
                                    <div class="nx-theme-card-inner">
                                        <div class="nx-theme-card-preview" style="background:linear-gradient(135deg,#F8FAFC 50%,#1E293B 50%);border-color:#CBD5E1;"></div>
                                        <span class="nx-theme-card-label">⚙️ Sistema</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        {{-- Cor primária --}}
                        <div class="nx-field">
                            <label style="margin-bottom:12px;">Cor Primária</label>
                            @php $pc = old('primary_color', $settings['primary_color'] ?? 'blue'); @endphp
                            <div class="nx-color-swatches">
                                @foreach([
                                    ['value'=>'blue',   'bg'=>'#3B82F6', 'label'=>'Azul Nexora'],
                                    ['value'=>'indigo', 'bg'=>'#6366F1', 'label'=>'Índigo'],
                                    ['value'=>'violet', 'bg'=>'#8B5CF6', 'label'=>'Violeta'],
                                    ['value'=>'cyan',   'bg'=>'#06B6D4', 'label'=>'Ciano'],
                                    ['value'=>'green',  'bg'=>'#10B981', 'label'=>'Verde'],
                                    ['value'=>'amber',  'bg'=>'#F59E0B', 'label'=>'Âmbar'],
                                    ['value'=>'rose',   'bg'=>'#F43F5E', 'label'=>'Rosa'],
                                ] as $color)
                                    <label class="nx-color-swatch" title="{{ $color['label'] }}">
                                        <input type="radio" name="primary_color"
                                               value="{{ $color['value'] }}"
                                               {{ $pc === $color['value'] ? 'checked' : '' }}>
                                        <span class="nx-color-swatch-dot"
                                              style="background:{{ $color['bg'] }};color:{{ $color['bg'] }};"></span>
                                    </label>
                                @endforeach
                            </div>
                            <small style="margin-top:10px; display:block;">Afeta botões, badges e elementos de destaque do sistema.</small>
                        </div>

                        {{-- Densidade e Barra lateral --}}
                        <div class="nx-settings-row">
                            <div class="nx-field">
                                <label for="ui_density">Densidade da Interface</label>
                                <select id="ui_density" name="ui_density">
                                    @php $density = old('ui_density', $settings['ui_density'] ?? 'comfortable'); @endphp
                                    <option value="comfortable" {{ $density === 'comfortable' ? 'selected' : '' }}>Confortável — mais espaçada</option>
                                    <option value="compact"     {{ $density === 'compact'     ? 'selected' : '' }}>Compacta — mais dados na tela</option>
                                </select>
                                <small>Ajusta o padding global das tabelas e cards.</small>
                            </div>
                            <div class="nx-field">
                                <label for="sidebar_default">Barra Lateral Padrão</label>
                                <select id="sidebar_default" name="sidebar_default">
                                    @php $sb = old('sidebar_default', $settings['sidebar_default'] ?? 'expanded'); @endphp
                                    <option value="expanded"  {{ $sb === 'expanded'  ? 'selected' : '' }}>Expandida — sempre visível</option>
                                    <option value="collapsed" {{ $sb === 'collapsed' ? 'selected' : '' }}>Recolhida — ícones apenas</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="nx-settings-footer">
                        <button type="submit" class="nx-btn nx-btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                <polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                            </svg>
                            Salvar Configurações
                        </button>
                    </div>
                </div>

                {{-- ┌─────────────────────────────┐
                     │  ABA: SEGURANÇA             │
                     └─────────────────────────────┘ --}}
                <div class="nx-settings-content nx-form-card" id="tab-seguranca">

                    <div class="nx-settings-section-header">
                        <div class="nx-settings-section-icon" style="background:rgba(239,68,68,.1);color:#EF4444;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </div>
                        <div class="nx-settings-section-text">
                            <p class="nx-settings-section-title">Segurança e Sistema</p>
                            <p class="nx-settings-section-desc">Sessão, auditoria e controle de acesso</p>
                        </div>
                    </div>

                    <div class="nx-settings-body">

                        {{-- Tempo de sessão --}}
                        <div class="nx-field">
                            <label for="session_timeout">Tempo Limite de Sessão</label>
                            <select id="session_timeout" name="session_timeout" style="max-width:320px;">
                                @php $st = old('session_timeout', $settings['session_timeout'] ?? '120'); @endphp
                                <option value="15"   {{ $st == '15'   ? 'selected' : '' }}>15 minutos</option>
                                <option value="30"   {{ $st == '30'   ? 'selected' : '' }}>30 minutos</option>
                                <option value="60"   {{ $st == '60'   ? 'selected' : '' }}>1 hora</option>
                                <option value="120"  {{ $st == '120'  ? 'selected' : '' }}>2 horas</option>
                                <option value="480"  {{ $st == '480'  ? 'selected' : '' }}>8 horas</option>
                                <option value="0"    {{ $st == '0'    ? 'selected' : '' }}>Nunca expirar</option>
                            </select>
                            <small>Após o período de inatividade o usuário será desconectado automaticamente.</small>
                        </div>

                        {{-- Força de senha --}}
                        <div class="nx-toggle-row">
                            <div class="nx-toggle-info">
                                <span class="nx-toggle-label">Exigir Senha Forte</span>
                                <p class="nx-toggle-desc">Obriga o uso de letras maiúsculas, números e caracteres especiais nos cadastros de usuário.</p>
                            </div>
                            <label class="nx-switch">
                                <input type="checkbox" name="password_strength" value="1"
                                       {{ old('password_strength', $settings['password_strength'] ?? '1') == '1' ? 'checked' : '' }}>
                                <span class="nx-switch-track"></span>
                            </label>
                        </div>

                        {{-- Log de atividades --}}
                        <div class="nx-toggle-row">
                            <div class="nx-toggle-info">
                                <span class="nx-toggle-label">Logs de Atividade</span>
                                <p class="nx-toggle-desc">Registra todas as ações executadas pelos usuários para fins de auditoria.</p>
                            </div>
                            <label class="nx-switch">
                                <input type="checkbox" name="activity_log" value="1"
                                       {{ old('activity_log', $settings['activity_log'] ?? '1') == '1' ? 'checked' : '' }}>
                                <span class="nx-switch-track"></span>
                            </label>
                        </div>

                        {{-- Modo manutenção --}}
                        <div class="nx-toggle-row">
                            <div class="nx-toggle-info">
                                <span class="nx-toggle-label">Modo Manutenção</span>
                                <p class="nx-toggle-desc">
                                    Bloqueia o acesso de todos os usuários não-administradores enquanto o sistema está em manutenção.
                                    <strong style="color:#DC2626;"> Ative com cautela!</strong>
                                </p>
                            </div>
                            <label class="nx-switch">
                                <input type="checkbox" name="maintenance_mode" value="1"
                                       {{ old('maintenance_mode', $settings['maintenance_mode'] ?? '0') == '1' ? 'checked' : '' }}>
                                <span class="nx-switch-track"></span>
                            </label>
                        </div>

                        {{-- Card de aviso de manutenção --}}
                        @if(($settings['maintenance_mode'] ?? '0') == '1')
                        <div class="nx-security-card">
                            <div class="nx-security-card-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                                    <line x1="12" y1="9" x2="12" y2="13"/>
                                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                                </svg>
                            </div>
                            <div class="nx-security-card-text">
                                <span class="nx-security-card-title">⚠ Modo Manutenção Ativo</span>
                                <p class="nx-security-card-desc">
                                    O sistema está bloqueado para usuários não-administradores. Lembre-se de desativar após concluir a manutenção.
                                </p>
                            </div>
                        </div>
                        @endif

                    </div>

                    <div class="nx-settings-footer">
                        <button type="submit" class="nx-btn nx-btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                <polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                            </svg>
                            Salvar Configurações
                        </button>
                    </div>
                </div>

                {{-- ┌─────────────────────────────┐
                     │  ABA: REGRAS DE ESTOQUE      │
                     └─────────────────────────────┘ --}}
                <div class="nx-settings-content nx-form-card" id="tab-estoque">

                    <div class="nx-settings-section-header">
                        <div class="nx-settings-section-icon" style="background:rgba(16,185,129,.1);color:#10B981;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                                <path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/>
                            </svg>
                        </div>
                        <div class="nx-settings-section-text">
                            <p class="nx-settings-section-title">Regras de Estoque e Inventário</p>
                            <p class="nx-settings-section-desc">Controle de disponibilidade e reserva de produtos no ato da venda</p>
                        </div>
                    </div>

                    <div class="nx-settings-body">

                        {{-- Venda sem estoque --}}
                        <div class="nx-field">
                            <label for="allow_sale_no_stock">Permitir Venda Sem Estoque</label>
                            <select id="allow_sale_no_stock" name="allow_sale_no_stock" style="max-width:360px;">
                                @php $ans = old('allow_sale_no_stock', $settings['allow_sale_no_stock'] ?? 'nao'); @endphp
                                <option value="nao"       {{ $ans === 'nao'       ? 'selected' : '' }}>🚫 Não permitir — bloqueia o botão Finalizar Venda</option>
                                <option value="autorizar" {{ $ans === 'autorizar' ? 'selected' : '' }}>🔑 Apenas com autorização — exige senha do gerente</option>
                                <option value="sim"       {{ $ans === 'sim'       ? 'selected' : '' }}>✅ Permitir — venda livre mesmo com saldo zerado</option>
                            </select>
                            <small>
                                <strong>Não:</strong> o botão "Finalizar Venda" é bloqueado quando estoque &lt; quantidade.<br>
                                <strong>Autorização:</strong> abre um prompt de senha do gerente antes de prosseguir.<br>
                                <strong>Sim:</strong> sem restrição — permite estoque negativo.
                            </small>
                            @error('allow_sale_no_stock')<small style="color:#EF4444;">{{ $message }}</small>@enderror
                        </div>

                        {{-- Momento de reserva --}}
                        <div class="nx-field" style="margin-top:4px;">
                            <label for="stock_reserve_moment">Momento de Reserva de Estoque</label>
                            <select id="stock_reserve_moment" name="stock_reserve_moment" style="max-width:360px;">
                                @php $srm = old('stock_reserve_moment', $settings['stock_reserve_moment'] ?? 'nota'); @endphp
                                <option value="pedido" {{ $srm === 'pedido' ? 'selected' : '' }}>📋 No Pedido — reserva ao confirmar o pedido</option>
                                <option value="nota"   {{ $srm === 'nota'   ? 'selected' : '' }}>🧾 Na Emissão da Nota — reserva somente ao emitir NF-e</option>
                            </select>
                            <small>Define quando o produto sai do saldo disponível no estoque.</small>
                        </div>

                        {{-- Alerta de estoque crítico --}}
                        <div class="nx-settings-row" style="margin-top:4px;">
                            <div class="nx-field">
                                <label for="critical_stock_percent">Alerta de Estoque Crítico (%)</label>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <input type="number" id="critical_stock_percent" name="critical_stock_percent"
                                           value="{{ old('critical_stock_percent', $settings['critical_stock_percent'] ?? '10') }}"
                                           placeholder="10" min="0" max="100" step="1" style="max-width:120px;">
                                    <span style="font-size:13px;color:#64748B;">% do estoque mínimo</span>
                                </div>
                                <small>O sistema exibe um alerta durante a digitação da venda quando o estoque disponível estiver abaixo deste percentual do estoque mínimo cadastrado no produto.</small>
                                @error('critical_stock_percent')<small style="color:#EF4444;">{{ $message }}</small>@enderror
                            </div>
                        </div>

                    </div>

                    <div class="nx-settings-footer">
                        <button type="submit" class="nx-btn nx-btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                <polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                            </svg>
                            Salvar Configurações
                        </button>
                    </div>
                </div>

                {{-- ┌─────────────────────────────┐
                     │  ABA: REGRAS FISCAIS        │
                     └─────────────────────────────┘ --}}
                <div class="nx-settings-content nx-form-card" id="tab-fiscal-config">

                    <div class="nx-settings-section-header">
                        <div class="nx-settings-section-icon" style="background:rgba(236,72,153,.1);color:#EC4899;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
                            </svg>
                        </div>
                        <div class="nx-settings-section-text">
                            <p class="nx-settings-section-title">Regras Fiscais e Tributárias</p>
                            <p class="nx-settings-section-desc">Automatize impostos e garanta conformidade com a SEFAZ</p>
                        </div>
                    </div>

                    <div class="nx-settings-body">

                        {{-- CFOP Padrão --}}
                        <div class="nx-settings-row">
                            <div class="nx-field">
                                <label for="default_cfop">CFOP Padrão de Saída</label>
                                <select id="default_cfop" name="default_cfop">
                                    @php $cfop = old('default_cfop', $settings['default_cfop'] ?? '5102'); @endphp
                                    <option value="5102" {{ $cfop === '5102' ? 'selected' : '' }}>5.102 — Venda dentro do estado (ICMS normal)</option>
                                    <option value="5101" {{ $cfop === '5101' ? 'selected' : '' }}>5.101 — Venda de produção do estabelecimento</option>
                                    <option value="6102" {{ $cfop === '6102' ? 'selected' : '' }}>6.102 — Venda para outro estado</option>
                                    <option value="6101" {{ $cfop === '6101' ? 'selected' : '' }}>6.101 — Venda interestadual de produção própria</option>
                                    <option value="5405" {{ $cfop === '5405' ? 'selected' : '' }}>5.405 — Venda com ST (Substituição Tributária)</option>
                                    <option value="5910" {{ $cfop === '5910' ? 'selected' : '' }}>5.910 — Remessa em bonificação</option>
                                    <option value="outro" {{ $cfop === 'outro' ? 'selected' : '' }}>Outro — definir manualmente na venda</option>
                                </select>
                                <small>O sistema sugere este CFOP automaticamente ao criar um pedido de venda.</small>
                                @error('default_cfop')<small style="color:#EF4444;">{{ $message }}</small>@enderror
                            </div>

                            <div class="nx-field">
                                <label for="emission_environment">Ambiente de Emissão</label>
                                <select id="emission_environment" name="emission_environment">
                                    @php $env = old('emission_environment', $settings['emission_environment'] ?? 'homologacao'); @endphp
                                    <option value="homologacao" {{ $env === 'homologacao' ? 'selected' : '' }}>🧪 Homologação — ambiente de testes (SEFAZ)</option>
                                    <option value="producao"    {{ $env === 'producao'    ? 'selected' : '' }}>🔴 Produção — notas com validade fiscal real</option>
                                </select>
                                <small>
                                    <strong style="color:#DC2626;">Atenção:</strong> Em produção, as notas emitidas têm validade jurídica e fiscal.
                                </small>
                                @error('emission_environment')<small style="color:#EF4444;">{{ $message }}</small>@enderror
                            </div>
                        </div>

                        {{-- Emissão automática de NF-e --}}
                        <div class="nx-toggle-row">
                            <div class="nx-toggle-info">
                                <span class="nx-toggle-label">Emissão Automática de NF-e / NFC-e</span>
                                <p class="nx-toggle-desc">
                                    Ao finalizar a venda, o sistema dispara automaticamente a transmissão para a SEFAZ.
                                    Se desativado, a emissão deve ser feita manualmente no módulo Fiscal.
                                </p>
                            </div>
                            <label class="nx-switch">
                                <input type="checkbox" name="auto_emit_nfe" value="1"
                                       {{ old('auto_emit_nfe', $settings['auto_emit_nfe'] ?? '0') == '1' ? 'checked' : '' }}>
                                <span class="nx-switch-track"></span>
                            </label>
                        </div>

                        {{-- Cálculo de impostos em tempo real --}}
                        <div class="nx-toggle-row">
                            <div class="nx-toggle-info">
                                <span class="nx-toggle-label">Cálculo de Impostos em Tempo Real</span>
                                <p class="nx-toggle-desc">
                                    Calcula ICMS, ST e outros impostos conforme os itens são adicionados ao pedido.
                                    Requer integração com tabela fiscal (NCM/CEST) devidamente preenchida.
                                </p>
                            </div>
                            <label class="nx-switch">
                                <input type="checkbox" name="realtime_tax_calc" value="1"
                                       {{ old('realtime_tax_calc', $settings['realtime_tax_calc'] ?? '0') == '1' ? 'checked' : '' }}>
                                <span class="nx-switch-track"></span>
                            </label>
                        </div>

                        {{-- Card aviso produção --}}
                        @if(($settings['emission_environment'] ?? 'homologacao') === 'producao')
                        <div class="nx-security-card" style="background:#FEF2F2;border-color:#FECACA;">
                            <div class="nx-security-card-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="12" y1="8" x2="12" y2="12"/>
                                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                            </div>
                            <div class="nx-security-card-text">
                                <span class="nx-security-card-title">🔴 Ambiente de Produção Ativo</span>
                                <p class="nx-security-card-desc">As notas emitidas neste ambiente são válidas juridicamente. Certifique-se de que todos os dados fiscais (CNPJ, IE, certificado digital) estão corretamente configurados.</p>
                            </div>
                        </div>
                        @endif

                    </div>

                    <div class="nx-settings-footer">
                        <button type="submit" class="nx-btn nx-btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                <polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                            </svg>
                            Salvar Configurações
                        </button>
                    </div>
                </div>

                {{-- ┌─────────────────────────────┐
                     │  ABA: REGRAS DE VENDA       │
                     └─────────────────────────────┘ --}}
                <div class="nx-settings-content nx-form-card" id="tab-vendas-config">

                    <div class="nx-settings-section-header">
                        <div class="nx-settings-section-icon" style="background:rgba(6,182,212,.1);color:#06B6D4;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                            </svg>
                        </div>
                        <div class="nx-settings-section-text">
                            <p class="nx-settings-section-title">Regras Gerenciais de Venda</p>
                            <p class="nx-settings-section-desc">Margens, descontos, tabelas de preço e comportamento do PDV</p>
                        </div>
                    </div>

                    <div class="nx-settings-body">

                        {{-- Tipo de Venda --}}
                        <div class="nx-field">
                            <label for="sale_type">Tipo de Operação de Venda</label>
                            <select id="sale_type" name="sale_type" style="max-width:360px;">
                                @php $st = old('sale_type', $settings['sale_type'] ?? 'hibrido'); @endphp
                                <option value="gerencial" {{ $st === 'gerencial' ? 'selected' : '' }}>📊 Gerencial — apenas controle interno, sem envio de nota</option>
                                <option value="fiscal"    {{ $st === 'fiscal'    ? 'selected' : '' }}>🧾 Fiscal — obrigatório dados fiscais e envio para SEFAZ</option>
                                <option value="hibrido"   {{ $st === 'hibrido'   ? 'selected' : '' }}>⚙️ Híbrido — o sistema pergunta ao finalizar a venda</option>
                            </select>
                            <small>
                                <strong>Gerencial:</strong> ideal para controle interno sem emissão fiscal.<br>
                                <strong>Fiscal:</strong> obriga preenchimento de CNPJ/CPF e transmissão automática.<br>
                                <strong>Híbrido:</strong> o operador decide no fechamento se emite nota ou não.
                            </small>
                            @error('sale_type')<small style="color:#EF4444;">{{ $message }}</small>@enderror
                        </div>

                        {{-- Tabela de preços e validade de orçamento --}}
                        <div class="nx-settings-row" style="margin-top:4px;">
                            <div class="nx-field">
                                <label for="active_price_table">Tabela de Preços Ativa</label>
                                <select id="active_price_table" name="active_price_table">
                                    @php $apt = old('active_price_table', $settings['active_price_table'] ?? 'varejo'); @endphp
                                    <option value="varejo"       {{ $apt === 'varejo'       ? 'selected' : '' }}>🏪 Varejo — preço unitário para consumidor final</option>
                                    <option value="atacado"      {{ $apt === 'atacado'      ? 'selected' : '' }}>📦 Atacado — preços para revenda em quantidade</option>
                                    <option value="promocional"  {{ $apt === 'promocional'  ? 'selected' : '' }}>🏷️ Promocional — preços de campanha ativa</option>
                                </select>
                                <small>Define qual tabela de preços o PDV consulta por padrão ao adicionar um produto.</small>
                                @error('active_price_table')<small style="color:#EF4444;">{{ $message }}</small>@enderror
                            </div>

                            <div class="nx-field">
                                <label for="quote_validity_days">Validade de Orçamentos (dias)</label>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <input type="number" id="quote_validity_days" name="quote_validity_days"
                                           value="{{ old('quote_validity_days', $settings['quote_validity_days'] ?? '7') }}"
                                           placeholder="7" min="1" max="365" step="1" style="max-width:120px;">
                                    <span style="font-size:13px;color:#64748B;">dias</span>
                                </div>
                                <small>Após este período, o orçamento expira e não pode mais ser convertido em pedido sem autorização.</small>
                                @error('quote_validity_days')<small style="color:#EF4444;">{{ $message }}</small>@enderror
                            </div>
                        </div>

                        {{-- Desconto máximo --}}
                        <div class="nx-settings-row">
                            <div class="nx-field">
                                <label for="max_discount_percent">Limite de Desconto por Vendedor (%)</label>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <input type="number" id="max_discount_percent" name="max_discount_percent"
                                           value="{{ old('max_discount_percent', $settings['max_discount_percent'] ?? '5') }}"
                                           placeholder="5" min="0" max="100" step="0.5" style="max-width:120px;">
                                    <span style="font-size:13px;color:#64748B;">%</span>
                                </div>
                                <small>Acima deste limite, o sistema exige senha do gerente para aplicar o desconto.</small>
                                @error('max_discount_percent')<small style="color:#EF4444;">{{ $message }}</small>@enderror
                            </div>
                        </div>

                        {{-- Bloqueio margem negativa --}}
                        <div class="nx-toggle-row">
                            <div class="nx-toggle-info">
                                <span class="nx-toggle-label">Bloqueio de Margem Negativa</span>
                                <p class="nx-toggle-desc">
                                    Impede que o vendedor finalize uma venda com preço abaixo do custo cadastrado no produto.
                                    Requer preço de custo preenchido no cadastro de produtos.
                                </p>
                            </div>
                            <label class="nx-switch">
                                <input type="checkbox" name="allow_negative_margin" value="1"
                                       {{ old('allow_negative_margin', $settings['allow_negative_margin'] ?? '0') == '1' ? 'checked' : '' }}>
                                <span class="nx-switch-track"></span>
                            </label>
                        </div>

                        {{-- Exigir CPF na nota --}}
                        <div class="nx-toggle-row">
                            <div class="nx-toggle-info">
                                <span class="nx-toggle-label">Exigir CPF / CNPJ na Nota</span>
                                <p class="nx-toggle-desc">
                                    Torna o campo de documento do cliente obrigatório no fechamento da venda fiscal.
                                    Sem o documento informado, o sistema bloqueia a emissão da nota.
                                </p>
                            </div>
                            <label class="nx-switch">
                                <input type="checkbox" name="require_cpf_on_note" value="1"
                                       {{ old('require_cpf_on_note', $settings['require_cpf_on_note'] ?? '0') == '1' ? 'checked' : '' }}>
                                <span class="nx-switch-track"></span>
                            </label>
                        </div>

                    </div>

                    <div class="nx-settings-footer">
                        <button type="submit" class="nx-btn nx-btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                <polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                            </svg>
                            Salvar Configurações
                        </button>
                    </div>
                </div>

            </div>{{-- /.nx-settings-panels (real closing) --}}


        </div>{{-- /.nx-settings-layout --}}
    </form>

</div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    /* ── Tab switching ── */
    const navItems = document.querySelectorAll('.nx-settings-nav-item[data-tab]');
    const panels   = document.querySelectorAll('.nx-settings-content');

    function activateTab(tabId) {
        navItems.forEach(btn => btn.classList.toggle('active', btn.dataset.tab === tabId));
        panels.forEach(panel => {
            panel.classList.toggle('active', panel.id === 'tab-' + tabId);
        });
        history.replaceState(null, '', '#' + tabId);
    }

    navItems.forEach(btn => {
        btn.addEventListener('click', () => activateTab(btn.dataset.tab));
    });

    /* Restore tab from hash */
    const hash = location.hash.replace('#', '');
    if (hash && document.getElementById('tab-' + hash)) {
        activateTab(hash);
    }

    /* ── CNPJ mask ── */
    const cnpjInput = document.getElementById('company_cnpj');
    if (cnpjInput) {
        cnpjInput.addEventListener('input', function () {
            let v = this.value.replace(/\D/g, '').slice(0, 14);
            v = v.replace(/^(\d{2})(\d)/, '$1.$2');
            v = v.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
            v = v.replace(/\.(\d{3})(\d)/, '.$1/$2');
            v = v.replace(/(\d{4})(\d)/, '$1-$2');
            this.value = v;
        });
    }

    /* ── CEP mask ── */
    const cepInput = document.getElementById('company_zipcode');
    if (cepInput) {
        cepInput.addEventListener('input', function () {
            let v = this.value.replace(/\D/g, '').slice(0, 8);
            v = v.replace(/^(\d{5})(\d)/, '$1-$2');
            this.value = v;
        });
    }

    /* ── Phone mask ── */
    const phoneInput = document.getElementById('company_phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function () {
            let v = this.value.replace(/\D/g, '').slice(0, 11);
            if (v.length <= 10) {
                v = v.replace(/^(\d{2})(\d{4})(\d)/, '($1) $2-$3');
            } else {
                v = v.replace(/^(\d{2})(\d{5})(\d)/, '($1) $2-$3');
            }
            this.value = v;
        });
    }
})();
</script>
@endpush

