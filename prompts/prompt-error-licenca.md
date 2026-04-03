# ⚠️ Guia de Design: Modal de Aviso de Licença (Nexora ERP)

Este guia documenta o padrão visual e técnico para a criação de uma janela modal centralizada, destinada a alertar o usuário sobre a ausência de uma licença ativa no sistema Nexora. O design deve ser intrusivo o suficiente para captar a atenção, mas manter a estética refinada do ERP.

---

## 🎨 Elementos de Interface (UI)

| Componente | Estilo | Comportamento |
| :--- | :--- | :--- |
| **Overlay (Fundo)** | Escuro e semi-transparente | Cobre toda a tela atrás do modal para focar a atenção. |
| **Container (Modal)** | Glassmorphism Profundo | Centralizado, com `backdrop-blur` intenso e borda sutil. |
| **Ícone de Alerta** | Amarelo/Laranja Neon | Posicionado no topo para indicar "Aviso/Atenção". |
| **Tipografia** | Limpa e Hierárquica | Texto principal em destaque, corpo do texto legível. |
| **Botão de Ação** | Gradiente Nexora (Ciano) | Foco na regularização da licença. |

---

## 🛠️ Estrutura do Componente React (`LicenseWarningModal.jsx`)

Para garantir a centralização perfeita e o comportamento de modal, utilizaremos classes utilitárias do Tailwind CSS.

```jsx
import React from 'react';
import { Head } from '@inertiajs/react';
import { AlertTriangle, Headset, X } from 'lucide-react';

export default function LicenseWarningModal({ onClose }) {
    return (
        <>
            <Head title="Aviso de Licença - Nexora ERP" />

            {/* Overlay de Fundo (Escurece a tela atrás) */}
            <div className="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm transition-opacity" aria-hidden="true" />

            {/* Container do Modal (Centralização Fixa) */}
            <div className="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto">
                
                {/* Janela Modal - Glassmorphism Style */}
                <div className="relative w-full max-w-lg rounded-2xl border border-white/10 bg-[#0a0f1d]/80 p-8 backdrop-blur-2xl shadow-2xl shadow-black/50 transform transition-all">
                    
                    {/* Botão Fechar (Opcional, dependendo da regra de negócio) */}
                    <button 
                        onClick={onClose}
                        className="absolute top-4 right-4 p-1.5 rounded-lg text-slate-500 hover:bg-white/5 hover:text-white transition-colors"
                    >
                        <X size={20} />
                    </button>

                    {/* Conteúdo do Modal */}
                    <div className="text-center">
                        
                        {/* Ícone de Alerta em Destaque */}
                        <div className="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-amber-500/10 border border-amber-500/30 shadow-lg shadow-amber-500/10">
                            <AlertTriangle className="h-10 w-10 text-amber-400" strokeWidth={1.5} />
                        </div>

                        {/* Mensagem Solicitada */}
                        <div className="space-y-4 text-slate-300">
                            <p className="text-lg leading-relaxed">
                                Você está utilizando o <strong className="font-bold text-white tracking-tight">Nexora ERP</strong> sem uma licença ativa.
                            </p>
                            
                            <p className="text-sm leading-relaxed text-slate-400">
                                Para continuar usando o sistema de forma livre e sem interrupções, regularize sua licença junto ao suporte.
                            </p>
                            
                            <p className="text-xs leading-relaxed text-slate-500 italic">
                                Enquanto a licença não for paga, este aviso continuará aparecendo periodicamente.
                            </p>
                        </div>

                        {/* Ações do Modal */}
                        <div className="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                            <button className="flex items-center justify-center gap-2.5 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-500 px-6 py-3 font-semibold text-white shadow-lg shadow-cyan-500/20 transition-all hover:brightness-110 active:scale-[0.98]">
                                <Headset size={18} />
                                Falar com o Suporte
                            </button>
                            <button 
                                onClick={onClose}
                                className="rounded-lg border border-white/10 bg-white/5 px-6 py-3 text-sm font-medium text-slate-400 transition-colors hover:bg-white/10 hover:text-white"
                            >
                                Entendi, fechar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
```
