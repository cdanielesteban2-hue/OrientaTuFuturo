'use client';

import React from 'react';

interface VocationalHeroProps {
  onStart: () => void;
  onOpenEthicsModal: () => void;
}

export const VocationalHero: React.FC<VocationalHeroProps> = ({ onStart, onOpenEthicsModal }) => {
  return (
    <div className="relative overflow-hidden py-16 sm:py-24">
      <div className="max-w-4xl mx-auto px-4 text-center">
        {/* Badge Institucional */}
        <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-50 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800 mb-6">
          <span>🎓 Orientación Vocacional Universitaria</span>
          <span>•</span>
          <span>Modelo John Holland (RIASEC)</span>
        </div>

        {/* Título Principal */}
        <h1 className="text-4xl sm:text-6xl font-heading font-black text-slate-900 dark:text-white tracking-tight leading-tight mb-6">
          Descubre tu vocación profesional y proyecta tus <span className="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">sueños universitarios</span>
        </h1>

        {/* Descripción para grados 10 y 11 */}
        <p className="text-lg sm:text-xl text-slate-600 dark:text-slate-300 leading-relaxed max-w-2xl mx-auto mb-10 font-normal">
          Un test rápido, gratuito y científicamente validado para estudiantes de grados 10° y 11°. Evalúa tus intereses, habilidades, hábitos de estudio y preferencias para encontrar las carreras que mejor encajan con tu futuro en Colombia.
        </p>

        {/* Botones de Acción */}
        <div className="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
          <button
            type="button"
            onClick={onStart}
            className="w-full sm:w-auto px-9 py-4 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-extrabold text-base shadow-xl shadow-blue-600/30 hover:scale-[1.02] transition"
          >
            🚀 Iniciar Test Vocacional Gratuito
          </button>

          <button
            type="button"
            onClick={onOpenEthicsModal}
            className="w-full sm:w-auto px-7 py-4 rounded-2xl bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold text-sm border border-slate-200 dark:border-slate-800 transition"
          >
            ⚖️ Metodología, Fuentes y Reconocimientos
          </button>
        </div>

        {/* Métricas / Puntos Fuertes */}
        <div className="grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-3xl mx-auto pt-8 border-t border-slate-200 dark:border-slate-800">
          <div className="p-3">
            <div className="text-2xl font-black text-slate-900 dark:text-white">18</div>
            <div className="text-xs text-slate-500 font-medium">Preguntas Situacionales</div>
          </div>
          <div className="p-3">
            <div className="text-2xl font-black text-blue-600 dark:text-blue-400">5 - 8 min</div>
            <div className="text-xs text-slate-500 font-medium">Duración Estimada</div>
          </div>
          <div className="p-3">
            <div className="text-2xl font-black text-emerald-600 dark:text-emerald-400">6 Áreas</div>
            <div className="text-xs text-slate-500 font-medium">Tipología RIASEC</div>
          </div>
          <div className="p-3">
            <div className="text-2xl font-black text-amber-500">100%</div>
            <div className="text-xs text-slate-500 font-medium">Gratis y Sin Registro</div>
          </div>
        </div>
      </div>
    </div>
  );
};
