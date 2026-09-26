'use client';

import React from 'react';
import { Career } from '../types/vocational';

interface CareerCardProps {
  career: Career;
  index: number;
}

export const CareerCard: React.FC<CareerCardProps> = ({ career, index }) => {
  return (
    <div className="group relative bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-7 shadow-sm hover:shadow-xl hover:border-blue-500/50 transition-all duration-300 flex flex-col justify-between">
      
      {/* Parte Superior: Encabezado e Índices */}
      <div>
        <div className="flex items-center justify-between gap-3 mb-3">
          <span className="text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800">
            {career.area}
          </span>
          <span className="text-xs font-semibold text-slate-500 dark:text-slate-400">
            #{index + 1} Afinidad
          </span>
        </div>

        <h3 className="text-xl font-extrabold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition mb-2">
          {career.name}
        </h3>

        {/* Metadatos Rápidos */}
        <div className="flex flex-wrap items-center gap-3 text-xs text-slate-500 dark:text-slate-400 mb-4 pb-4 border-b border-slate-100 dark:border-slate-800">
          <span className="flex items-center gap-1.5 font-medium">
            🎓 {career.degreeType}
          </span>
          <span>•</span>
          <span className="flex items-center gap-1.5 font-medium">
            ⏱️ {career.durationSemesters} Semestres
          </span>
          <span>•</span>
          <span className="flex items-center gap-1.5 font-medium text-emerald-600 dark:text-emerald-400 font-bold">
            📈 {career.employabilityRate}% Empleabilidad
          </span>
        </div>

        {/* Por Qué Encaja Contigo (IA / Algoritmo) */}
        <div className="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/40 border border-slate-200/80 dark:border-slate-800 mb-4">
          <p className="text-xs text-slate-700 dark:text-slate-300 leading-relaxed font-normal">
            <strong className="text-blue-600 dark:text-blue-400">¿Por qué te encaja?:</strong> {career.whyItFits}
          </p>
        </div>

        {/* Habilidades Requeridas */}
        <div className="mb-4">
          <span className="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider block mb-2">
            Habilidades Clave:
          </span>
          <div className="flex flex-wrap gap-1.5">
            {career.requiredSkills.map((skill, idx) => (
              <span
                key={idx}
                className="text-[11px] font-semibold px-2.5 py-0.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300"
              >
                {skill}
              </span>
            ))}
          </div>
        </div>
      </div>

      {/* Parte Inferior: Universidades y Acción */}
      <div className="pt-4 border-t border-slate-100 dark:border-slate-800 mt-2">
        <span className="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider block mb-1.5">
          Universidades en Colombia:
        </span>
        <p className="text-xs text-slate-600 dark:text-slate-400 line-clamp-2 mb-4">
          {career.universitiesColombia.join(', ')}
        </p>

        <a
          href="#explorar"
          className="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl text-xs font-bold bg-slate-900 dark:bg-slate-800 hover:bg-blue-600 text-white dark:hover:bg-blue-600 transition"
        >
          <span>Explorar Universidades y Becas</span>
          <span>→</span>
        </a>
      </div>
    </div>
  );
};
