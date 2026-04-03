# 🚀 Guia de Implementação: Tela de Login Nexora ERP
Este documento serve como referência técnica para o desenvolvimento da interface de autenticação do sistema **Nexora EMS**, utilizando **Laravel**, **React** e **Inertia.js**.

---

## 🎨 1. Conceito Visual: Glassmorphism
A interface utiliza a estética "vidro fosco", caracterizada por:
* **Transparência:** Uso de cores com opacidade baixa (`rgba`).
* **Desfoque:** Efeito de `backdrop-blur` para separar o card do fundo.
* **Contorno:** Bordas finas e sutis para simular a espessura do vidro.
* **Iluminação:** Gradientes neon que remetem à identidade visual do vídeo.

---

## 🛠️ 2. Stack Técnica
* **Backend:** Laravel 11.x
* **Frontend:** React (via Inertia.js)
* **Estilização:** Tailwind CSS
* **Build Tool:** Vite

---

## 💻 3. Código do Componente React (`Login.jsx`)

```jsx
import React from 'react';
import { Head, useForm } from '@inertiajs/react';

export default function Login() {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('login'));
    };

    return (
        <div className="relative flex min-h-screen items-center justify-center overflow-hidden bg-[#0a0f1d] font-sans">
            <Head title="Nexora ERP - Login" />

            {/* Elementos de Fundo (Círculos Neon) */}
            <div className="absolute h-[500px] w-[500px] rounded-full border border-cyan-500/20 opacity-20 animate-pulse"></div>
            <div className="absolute h-[800px] w-[800px] rounded-full border border-blue-500/10 opacity-10 animate-[pulse_8s_infinite]"></div>

            <div className="relative z-10 w-full max-w-md p-6">
                {/* Card Glassmorphism */}
                <div className="rounded-2xl border border-white/10 bg-white/5 p-8 backdrop-blur-xl shadow-2xl">
                    
                    {/* Branding */}
                    <div className="mb-8 text-center">
                        <h1 className="text-3xl font-bold tracking-tighter text-white">
                            NE<span className="text-cyan-400">X</span>ORA
                        </h1>
                        <p className="mt-2 text-sm text-slate-400 font-medium">Enterprise Management System</p>
                    </div>

                    <form onSubmit={submit} className="space-y-5">
                        {/* Campo Usuário/Email */}
                        <div>
                            <label className="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5 ml-1">Usuário</label>
                            <input 
                                type="email"
                                value={data.email}
                                onChange={e => setData('email', e.target.value)}
                                className="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-slate-600 outline-none transition-all focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/10"
                                placeholder="exemplo@nexora.com"
                                required
                            />
                            {errors.email && <span className="text-xs text-red-400 mt-1">{errors.email}</span>}
                        </div>

                        {/* Campo Senha */}
                        <div>
                            <label className="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5 ml-1">Senha</label>
                            <input 
                                type="password"
                                value={data.password}
                                onChange={e => setData('password', e.target.value)}
                                className="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-slate-600 outline-none transition-all focus:border-cyan-500/50 focus:ring-4 focus:ring-cyan-500/10"
                                placeholder="••••••••"
                                required
                            />
                        </div>

                        <div className="flex items-center justify-between px-1">
                            <label className="flex items-center text-xs text-slate-400 cursor-pointer">
                                <input type="checkbox" className="mr-2 rounded border-white/10 bg-white/5 text-cyan-500 focus:ring-0" />
                                Lembrar de mim
                            </label>
                            <a href="#" className="text-xs text-cyan-400 hover:underline">Esqueci minha senha</a>
                        </div>

                        {/* Botão de Ação */}
                        <button 
                            disabled={processing}
                            className="w-full rounded-lg bg-gradient-to-r from-blue-600 to-cyan-500 py-3.5 font-bold text-white shadow-lg shadow-cyan-500/20 transition-all hover:scale-[1.02] active:scale-95 disabled:opacity-50"
                        >
                            {processing ? 'Autenticando...' : 'ENTRAR NO SISTEMA'}
                        </button>
                    </form>

                    <div className="mt-10 border-t border-white/5 pt-6 text-center">
                        <p className="text-[10px] uppercase tracking-widest text-slate-600">
                            © 2026 Nexora Systems | Ubá-MG
                        </p>
                    </div>
                </div>
            </div>
        </div>
    );
}
```
4. Configurações Necessárias
   Tailwind CSS (tailwind.config.js)
   Certifique-se de que o Tailwind está configurado para ler seus arquivos React:
```jsx
export default {
    content: [
        "./resources/*/.blade.php",
        "./resources/*/.jsx",
    ],
    theme: {
        extend: {
        // Adicione animações personalizadas se necessário
        },
    },
    plugins: [require('@tailwindcss/forms')],
}

```

Laravel Controller (LoginController.php)
Ao usar Inertia, o retorno da sua rota de login deve ser:

```jsx
use Inertia\Inertia;

public function showLoginForm()
{
    return Inertia::render('Auth/Login');
}
```
