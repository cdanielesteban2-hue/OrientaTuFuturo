'use client';

import React from 'react';
import { INSTITUTIONAL_RECOGNITION } from '../lib/vocational-engine';

interface EthicsRecognitionModalProps {
  isOpen: boolean;
  onClose: () => void;
}

export const EthicsRecognitionModal: React.FC<EthicsRecognitionModalProps> = ({ isOpen, onClose }) => {
  if (!isOpen) return null;

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-md animate-fadeIn">
      <div 
        className="relative w-full max-w-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-2xl p-6 sm:p-8 overflow-y-auto max-h-[90vh]"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-title"
      >
        {/* Botón Cerrar */}
        <button
          onClick={onClose}
          className="absolute top-5 right-5 w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center transition"
          aria-label="Cerrar modal"
        >
          ✕
        </button>

        {/* Encabezado con Icono */}
        <div className="flex items-center gap-3 mb-5">
          <div className="w-12 h-12 rounded-2xl bg-amber-400/20 text-amber-500 flex items-center justify-center text-xl font-bold">
            ⚖️
          </div>
          <div>
            <span className="text-xs font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400">
              Marco Metodológico &amp; Ético
            </span>
            <h2 id="modal-title" className="text-2xl font-extrabold text-slate-900 dark:text-white">
              Fuentes de Referencia y Reconocimientos
            </h2>
          </div>
        </div>

        {/* Cita Obligatoria Destacada */}
        <div className="p-4 sm:p-5 rounded-2xl bg-blue-50 dark:bg-blue-950/40 border border-blue-200 dark:border-blue-800/60 mb-6">
          <p className="text-sm sm:text-base font-semibold text-blue-900 dark:text-blue-200 leading-relaxed italic">
            "{INSTITUTIONAL_RECOGNITION.mandatoryStatement}"
          </p>
        </div>

        {/* Desglose Institucional */}
        <div className="space-y-4 mb-6">
          <div className="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
            <h4 className="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-1">
              <span className="text-blue-500">●</span> Test Vocacional Filadd (Modelo John Holland - RIASEC)
            </h4>
            <p className="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
              Referencia principal para estructurar un test ágil y focalizado en estudiantes de grados 10° y 11°. Evalúa intereses, aptitudes, hábitos de estudio y preferencias en las 6 áreas ocupacionales tipológicas: Técnica-Práctica, Científica-Investigativa, Artística-Creativa, Social-Humanitaria, Empresarial-Comercial y Administrativa-Organizacional.
            </p>
          </div>

          <div className="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
            <h4 className="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-1">
              <span className="text-emerald-500">●</span> Universidad de Santander (UDES)
            </h4>
            <p className="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
              Inspiración en su modelo de orientación profesional enfocado en el autoconocimiento de la personalidad del joven bachiller y el mapeo claro de áreas del saber para mitigar la deserción universitaria en la educación superior colombiana.
            </p>
          </div>

          <div className="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
            <h4 className="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-1">
              <span className="text-amber-500">●</span> Universidad de Medellín (UVirtualAbierta)
            </h4>
            <p className="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
              Referencia en su enfoque de viaje de autoconocimiento donde los estudiantes clarifican sus sueños profesionales y preferencias académicas profundas antes del proceso de matrícula institucional.
            </p>
          </div>
        </div>

        {/* Disclaimer Obligatorio */}
        <div className="p-4 rounded-2xl bg-amber-50 dark:bg-amber-950/30 border border-amber-300 dark:border-amber-800/60 mb-6">
          <div className="flex items-start gap-3">
            <span className="text-lg">⚠️</span>
            <div>
              <h5 className="text-xs font-bold text-amber-900 dark:text-amber-300 uppercase tracking-wide mb-1">
                Aviso Legal y Deontológico
              </h5>
              <p className="text-xs sm:text-sm text-amber-800 dark:text-amber-200 font-medium leading-relaxed">
                {INSTITUTIONAL_RECOGNITION.disclaimer}
              </p>
            </div>
          </div>
        </div>

        {/* Botón de Aceptación */}
        <button
          onClick={onClose}
          className="w-full py-3.5 px-6 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold transition shadow-lg shadow-blue-600/25"
        >
          Entendido y De Acuerdo
        </button>
      </div>
    </div>
  );
};
