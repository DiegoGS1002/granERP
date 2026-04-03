Guia Técnico: Configurações Nexora ERP
Este módulo centraliza o comportamento global do sistema, permitindo que o administrador personalize a experiência da empresa e dos usuários.

## 1. Arquitetura de Dados (Backend Laravel)
   Para as configurações, a melhor abordagem é uma tabela settings do tipo Key-Value, para que você não precise alterar o Schema do banco sempre que adicionar uma nova opção.

Migration Sugerida:

```PHP
Schema::create('settings', function (Blueprint $table) {
    $table->id();
    $table->string('key')->unique(); // Ex: 'system_name', 'app_theme'
    $table->text('value')->nullable();
    $table->string('group'); // Ex: 'general', 'appearance', 'session'
    $table->timestamps();
});
```

---

## 2. Divisão de Módulos (Frontend React)
Conforme a imagem, @docs/design/layoutConfig.png, a tela é dividida em 4 pilares de configuração. Abaixo, a lógica de cada um:

A. Configurações Gerais (General)
Nome do Sistema: Define o title global e o texto do Header.

Fuso Horário: Crucial para os logs de auditoria e cálculos de NF-e.

Idioma: Alterna os arquivos de tradução (JSON) do frontend.

Formato de Data/Hora: Define como as tabelas de Vendas e Compras exibirão os timestamps.

---

## B. Preferências de Exibição (Appearance)
Tema: Alterna entre Claro, Escuro (o modo que vimos no vídeo) e Sistema.

Dica: Use uma classe no body ou o modo dark: do Tailwind.

Cor Primária: Altera a variável CSS --primary-color. Isso deve refletir nos botões e badges.

Densidade: Ajusta o padding global (Comfortable = 16px, Compact = 8px).

## C. Segurança e Sessão (Session)
Tempo Limite: Controla o SESSION_LIFETIME do Laravel.

Registro de Atividades: Ativa/Desativa o log de ações (Auditoria) nas tabelas do sistema.

Modo Manutenção: Bloqueia o acesso de usuários não-admin (via Middleware).

---

## 3. Implementação do Componente React
   Aqui está a estrutura de lógica para o formulário de configurações usando o hook useForm do Inertia:


```jsx

import { useForm } from '@inertiajs/react';

export default function ConfigSettings({ settings }) {
const { data, setData, post, processing } = useForm({
system_name: settings.system_name || 'Nexora ERP',
timezone: settings.timezone || 'UTC-03:00',
theme: settings.theme || 'claro',
primary_color: settings.primary_color || 'blue',
session_timeout: settings.session_timeout || '30',
maintenance_mode: settings.maintenance_mode || false,
});

    const submit = (e) => {
        e.preventDefault();
        post(route('settings.update'));
    };

    return (
        <form onSubmit={submit} className="grid grid-cols-12 gap-6">
            {/* O design deve seguir os cards brancos da imagem layoutConfig.jpg */}
            {/* Exemplo de Toggle de Manutenção */}
            <div className="flex items-center justify-between">
                <span>Modo Manutenção</span>
                <input 
                    type="checkbox" 
                    checked={data.maintenance_mode}
                    onChange={e => setData('maintenance_mode', e.target.checked)}
                />
            </div>

            <button disabled={processing} className="bg-blue-600 text-white px-4 py-2 rounded-lg">
                Salvar Alterações
            </button>
        </form>
    );
}

```

---

## 4. Regras de Negócio Importantes
   Cache de Configurações: Como as configurações são lidas em quase todas as páginas, use o Cache do Laravel:

```PHP
// No Provider ou Helper
$name = Cache::rememberForever('setting_name', function () {
return Setting::where('key', 'system_name')->value('value');
});

```

Segurança de Sessão: Ao alterar o "Tempo de Sessão", o sistema deve forçar o re-login de todos os usuários ou atualizar o cookie na próxima requisição.

Logs de Auditoria: Qualquer alteração nesta tela DEVE gerar um log (quem alterou, o valor antigo e o valor novo), pois impacta todos os usuários.

---

## 5. Próximos Passos para o seu Portfólio
   Como você está buscando uma vaga de Trainee, foque em mostrar que você entende a integração:

No Laravel: Mostre que você criou um Request validando os campos.

No React: Mostre que o sistema "reage" à mudança de cor ou tema sem precisar de F5 (usando estados globais ou Context API).

---

==========================================
# Estrutura de Conteúdo das Configurações
==========================================

---

## 1. Geral (Geral)
Foco: Identidade e funcionamento básico.

Nome do Sistema: Campo de texto para o nome personalizado (ex: Nexora ERP).

Slogan/Subtítulo: Texto que aparece abaixo do logo ou no dashboard.

Fuso Horário: Dropdown com as regiões (crucial para o timestamp de notas fiscais).

Idioma: Seleção de linguagem (Português, Inglês, Espanhol).

Formato de Data: (DD/MM/AAAA ou AAAA/MM/DD).

Formato de Hora: (12h ou 24h).

---

## 2. Empresa (Empresa)
Foco: Dados jurídicos e fiscais da licença.

Razão Social e Nome Fantasia: Campos para os dados oficiais.

CNPJ e Inscrição Estadual: Essencial para a emissão de documentos.

Endereço Completo: Logradouro, número, cidade e UF.

Logo da Empresa: Upload de imagem para aparecer nos relatórios e documentos PDF.

Contatos: E-mail e telefone comercial.

---

## 3. Financeiro (Financeiro)
   Foco: Regras de moedas e taxas.

Moeda Padrão: (R$, US$, etc.).

Símbolo Decimal: (Vírgula ou Ponto).

Taxas e Impostos Globais: Configuração de alíquotas padrão para cálculos rápidos.

Contas Padrão: Definição de qual conta bancária é a principal para recebimentos.

---

## 4. Notificações (Notificações)
   Foco: Comunicação interna e externa.

Alertas de Estoque: Ativar aviso quando um produto atingir o nível mínimo.

E-mails de Boas-vindas: Ativar envio automático para novos usuários.

Alertas do Sistema: Escolher se as notificações aparecem no navegador ou apenas por e-mail.

Integração WhatsApp: (Opcional) Chave de API para notificações de vendas.

---

## 5. Aparência (Aparência)
   Foco: Personalização da interface (UI).

Tema: Cards clicáveis para "Claro", "Escuro" ou "Sistema".

Cor Primária: Seleção de paleta (Azul Nexora, Verde, Roxo, etc.).

Densidade da Interface: Opções entre "Confortável" (mais espaçado) ou "Compacto" (mais dados na tela).

Barra Lateral: Opção de manter expandida ou recolhida por padrão.

---

## 6. Segurança e Sistema (Segurança)
   Foco: Integridade e acesso.

Tempo de Sessão: Dropdown (15min, 30min, 1h, Nunca expirar).

Força da Senha: Exigir caracteres especiais e números.

Modo Manutenção: Switch (Toggle) para bloquear o acesso de usuários enquanto o sistema é atualizado.

Logs de Atividade: Ativar/Desativar o rastro de quem editou o quê.

Backup do Banco de Dados: Botão para download manual ou agendamento automático.

Dica para o React (Inertia)
Para que essa tela não fique "pesada", você pode componentizar cada seção. No seu arquivo Settings.jsx, você pode usar um estado para controlar qual aba está ativa:

```jsx

const [activeTab, setActiveTab] = useState('general');

// No render:
{activeTab === 'general' && <GeneralSettings data={data} setData={setData} />}
{activeTab === 'appearance' && <AppearanceSettings data={data} setData={setData} />}

```

---

