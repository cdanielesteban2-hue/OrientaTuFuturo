'use client';

import React, { useState } from 'react';
import { TestResultScore } from '../types/vocational';
import { RiasecRadarChart } from './RiasecRadarChart';
import { CareerCard } from './CareerCard';
import { INSTITUTIONAL_RECOGNITION } from '../lib/vocational-engine';
import { RIASEC_PROFILES } from '../data/questions';

interface ResultsDashboardProps {
  results: TestResultScore;
  onRestart: () => void;
  onOpenEthicsModal: () => void;
}

export const ResultsDashboard: React.FC<ResultsDashboardProps> = ({
  results,
  onRestart,
  onOpenEthicsModal
}) => {
  const [copySuccess, setCopySuccess] = useState(false);

  const handleCopyLink = () => {
    if (typeof window !== 'undefined') {
      navigator.clipboard.writeText(window.location.href);
      setCopySuccess(true);
      setTimeout(() => setCopySuccess(false), 2500);
    }
  };

  const handleWhatsAppShare = () => {
    const text = encodeURIComponent(
      `¡Hola! Acabo de realizar el Test Vocacional de Orienta tu FUTURO (basado en el modelo Holland RIASEC, Filadd, UDES y UdeM). Mi área vocacional dominante es ${results.primaryArea.name} con código ${results.riasecCode}. ¡Descubre también tu carrera ideal!`
    );
    window.open(`https://api.whatsapp.com/send?text=${text}`, '_blank');
  };

  const handlePrint = () => {
    window.print();
  };

  return (
    <div className="w-full max-w-6xl mx-auto px-4 py-10 space-y-12">
      {/* Encabezado Principal */}
      <div className="text-center max-w-3xl mx-auto">
        <span className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-800 mb-4">
          🏆 Diagnóstico Vocacional Listo
        </span>
        <h1 className="text-3xl sm:text-5xl font-heading font-extrabold text-slate-900 dark:text-white tracking-tight mb-4">
          Tu Perfil Vocacional Personalizado
        </h1>
        <p className="text-slate-600 dark:text-slate-400 text-base sm:text-lg leading-relaxed">
          Hemos cruzado tus intereses, aptitudes, hábitos de estudio y visión de vida con el modelo tipológico de Holland y la oferta académica de la educación superior colombiana.
        </p>
      </div>

      {/* Tarjeta de Área Dominante & Código RIASEC */}
      <div
        className="rounded-3xl p-6 sm:p-10 border shadow-xl relative overflow-hidden"
        style={{
          borderColor: `${results.primaryArea.color}40`,
          background: `linear-gradient(135deg, ${results.primaryArea.bgLight} 0%, rgba(255,255,255,0.9) 100%)`
        }}
      >
        <div className="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 mb-6">
          <div>
            <div className="flex items-center gap-3 mb-2">
              <span
                className="text-xs font-extrabold uppercase tracking-widest px-3 py-1 rounded-full text-white"
                style={{ backgroundColor: results.primaryArea.color }}
              >
                Área Dominante ({results.percentages[results.primaryArea.key]}%)
              </span>
              <span className="text-xs font-bold text-slate-500 uppercase tracking-wider">
                Código Holland: <strong className="text-slate-900 font-extrabold">{results.riasecCode}</strong>
              </span>
            </div>
            <h2 className="text-2xl sm:text-4xl font-heading font-extrabold text-slate-900">
              {results.primaryArea.name}
            </h2>
            <p className="text-sm font-semibold text-slate-600 mt-1">
              {results.primaryArea.tagline}
            </p>
          </div>

          <div
            className="w-20 h-20 rounded-2xl flex items-center justify-center text-white text-2xl font-extrabold shadow-lg shrink-0"
            style={{ backgroundColor: results.primaryArea.color }}
          >
            {results.primaryArea.letter}
          </div>
        </div>

        <p className="text-sm sm:text-base text-slate-700 leading-relaxed mb-6">
          {results.primaryArea.description}
        </p>

        {/* Competencias y Ambientes Clave */}
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4 pt-6 border-t border-slate-200/80">
          <div>
            <span className="text-xs font-bold text-slate-500 uppercase tracking-wider block mb-2">
              Tus Fortalezas Cognitivas:
            </span>
            <ul className="space-y-1 text-xs sm:text-sm text-slate-700">
              {results.primaryArea.keySkills.map((skill, idx) => (
                <li key={idx} className="flex items-center gap-2">
                  <span className="text-blue-600 font-bold">✓</span> {skill}
                </li>
              ))}
            </ul>
          </div>

          <div>
            <span className="text-xs font-bold text-slate-500 uppercase tracking-wider block mb-2">
              Ambientes donde floreces:
            </span>
            <ul className="space-y-1 text-xs sm:text-sm text-slate-700">
              {results.primaryArea.workEnvironments.map((env, idx) => (
                <li key={idx} className="flex items-center gap-2">
                  <span className="text-emerald-600 font-bold">📍</span> {env}
                </li>
              ))}
            </ul>
          </div>
        </div>
      </div>

      {/* Gráfico Radar + Desglose Porcentual de las 6 Áreas */}
      <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        {/* Radar SVG */}
        <div className="lg:col-span-6 flex flex-col items-center">
          <div className="w-full text-center lg:text-left mb-4">
            <h3 className="text-xl font-heading font-extrabold text-slate-900 dark:text-white">
              Mapa Psicométrico RIASEC
            </h3>
            <p className="text-xs text-slate-500 dark:text-slate-400">
              Distribución de afinidad en las 6 tipologías vocacionales
            </p>
          </div>
          <RiasecRadarChart percentages={results.percentages} />
        </div>

        {/* Barras de Progreso Porcentuales */}
        <div className="lg:col-span-6 space-y-4">
          <h3 className="text-xl font-heading font-extrabold text-slate-900 dark:text-white mb-2">
            Desglose de Afinidad por Áreas
          </h3>

          {(['R', 'I', 'A', 'S', 'E', 'C'] as const).map((key) => {
            const profile = RIASEC_PROFILES[key];
            const pct = results.percentages[key];

            return (
              <div key={key} className="space-y-1">
                <div className="flex items-center justify-between text-xs sm:text-sm">
                  <span className="font-bold text-slate-800 dark:text-slate-200 flex items-center gap-2">
                    <span className="w-2.5 h-2.5 rounded-full" style={{ backgroundColor: profile.color }}></span>
                    {profile.name}
                  </span>
                  <strong style={{ color: profile.color }}>{pct}%</strong>
                </div>

                <div className="w-full h-3 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
                  <div
                    className="h-full rounded-full transition-all duration-700 ease-out"
                    style={{ width: `${pct}%`, backgroundColor: profile.color }}
                  ></div>
                </div>
              </div>
            );
          })}
        </div>
      </div>

      {/* Síntesis Diagnóstica (Inspirada en UDES y UVirtualAbierta) */}
      <div className="bg-slate-900 text-white rounded-3xl p-6 sm:p-10 border border-slate-800 shadow-2xl relative overflow-hidden">
        <div className="flex items-center gap-3 mb-4">
          <div className="w-10 h-10 rounded-xl bg-blue-600/30 text-blue-400 flex items-center justify-center font-bold text-lg">
            🧠
          </div>
          <div>
            <span className="text-xs font-bold text-blue-400 uppercase tracking-widest">
              Análisis Vocacional Integrado
            </span>
            <h3 className="text-xl sm:text-2xl font-bold text-white">
              ¿Por qué estas recomendaciones encajan contigo?
            </h3>
          </div>
        </div>

        <p className="text-slate-300 text-sm sm:text-base leading-relaxed whitespace-pre-line font-normal">
          {results.diagnosticRationale}
        </p>
      </div>

      {/* Carreras Recomendadas y Caminos Académicos */}
      <div>
        <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
          <div>
            <span className="text-xs font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400">
              Oportunidades Académicas
            </span>
            <h2 className="text-2xl sm:text-3xl font-heading font-extrabold text-slate-900 dark:text-white">
              Carreras Universitarias Recomendadas Para Ti
            </h2>
          </div>
          <p className="text-xs text-slate-500 dark:text-slate-400 max-w-sm">
            Programas con alta tasa de empleabilidad en Colombia que potencian tus talentos naturales.
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {results.recommendedCareers.map((career, idx) => (
            <CareerCard key={career.id} career={career} index={idx} />
          ))}
        </div>
      </div>

      {/* SECCIÓN OBLIGATORIA: RECONOCIMIENTOS Y ÉTICA VOCACIONAL */}
      <div className="rounded-3xl p-6 sm:p-8 bg-amber-50 dark:bg-slate-900 border-2 border-amber-300 dark:border-amber-900/60 shadow-lg">
        <div className="flex items-start gap-4">
          <div className="w-12 h-12 rounded-2xl bg-amber-400/30 text-amber-600 dark:text-amber-400 flex items-center justify-center text-2xl shrink-0">
            🏛️
          </div>
          <div className="space-y-3">
            <span className="text-xs font-extrabold uppercase tracking-wider text-amber-800 dark:text-amber-400">
              Reconocimiento de Fuentes y Transparencia Metodológica (Obligatorio)
            </span>

            {/* Texto de reconocimiento literal requerido */}
            <p className="text-sm sm:text-base font-bold text-slate-900 dark:text-white leading-relaxed">
              "{INSTITUTIONAL_RECOGNITION.mandatoryStatement}"
            </p>

            <p className="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
              {INSTITUTIONAL_RECOGNITION.methodologyNote}
            </p>

            {/* Disclaimer literal */}
            <div className="pt-2 border-t border-amber-200 dark:border-slate-800">
              <p className="text-xs font-semibold text-amber-900 dark:text-amber-300 italic">
                ⚠️ {INSTITUTIONAL_RECOGNITION.disclaimer}
              </p>
            </div>

            <button
              type="button"
              onClick={onOpenEthicsModal}
              className="text-xs font-bold text-blue-600 dark:text-blue-400 hover:underline pt-1 inline-flex items-center gap-1"
            >
              <span>Ver detalles de los tests de Filadd, UDES y UVirtualAbierta</span>
              <span>→</span>
            </button>
          </div>
        </div>
      </div>

      {/* Botones de Acción (Compartir, Guardar, Imprimir, Repetir) */}
      <div className="flex flex-wrap items-center justify-center gap-4 pt-6 border-t border-slate-200 dark:border-slate-800">
        <button
          type="button"
          onClick={handleWhatsAppShare}
          className="px-6 py-3.5 rounded-xl text-sm font-bold bg-emerald-600 hover:bg-emerald-700 text-white shadow-lg shadow-emerald-600/20 transition flex items-center gap-2"
        >
          <span>💬 Compartir en WhatsApp</span>
        </button>

        <button
          type="button"
          onClick={handleCopyLink}
          className="px-6 py-3.5 rounded-xl text-sm font-bold bg-slate-900 dark:bg-slate-800 hover:bg-blue-600 text-white transition flex items-center gap-2"
        >
          <span>{copySuccess ? '✓ Enlace Copiado' : '🔗 Copiar Enlace'}</span>
        </button>

        <button
          type="button"
          onClick={handlePrint}
          className="px-6 py-3.5 rounded-xl text-sm font-bold border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition flex items-center gap-2"
        >
          <span>🖨️ Descargar / Imprimir PDF</span>
        </button>

        <button
          type="button"
          onClick={onRestart}
          className="px-6 py-3.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800 dark:hover:text-white transition flex items-center gap-1"
        >
          <span>🔄 Repetir Test</span>
        </button>
      </div>
    </div>
  );
};
