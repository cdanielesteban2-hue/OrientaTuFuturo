'use client';

import React, { useState } from 'react';
import { VOCATIONAL_QUESTIONS, RIASEC_PROFILES } from '../data/questions';
import { RiasecKey } from '../types/vocational';

interface VocationalWizardProps {
  onComplete: (answers: Record<number, RiasecKey>) => void;
  onOpenEthicsModal: () => void;
}

export const VocationalWizard: React.FC<VocationalWizardProps> = ({ onComplete, onOpenEthicsModal }) => {
  const [currentQuestionIndex, setCurrentQuestionIndex] = useState<number>(0);
  const [answers, setAnswers] = useState<Record<number, RiasecKey>>({});
  const [isAutoAdvance, setIsAutoAdvance] = useState<boolean>(true);

  const totalQuestions = VOCATIONAL_QUESTIONS.length;
  const currentQuestion = VOCATIONAL_QUESTIONS[currentQuestionIndex];
  const progressPercent = Math.round(((currentQuestionIndex + 1) / totalQuestions) * 100);

  const handleSelectOption = (key: RiasecKey) => {
    const updated = { ...answers, [currentQuestion.id]: key };
    setAnswers(updated);

    if (currentQuestionIndex < totalQuestions - 1) {
      if (isAutoAdvance) {
        setTimeout(() => {
          setCurrentQuestionIndex((prev) => prev + 1);
        }, 320);
      }
    }
  };

  const handleNext = () => {
    if (currentQuestionIndex < totalQuestions - 1) {
      setCurrentQuestionIndex((prev) => prev + 1);
    }
  };

  const handlePrev = () => {
    if (currentQuestionIndex > 0) {
      setCurrentQuestionIndex((prev) => prev - 1);
    }
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (Object.keys(answers).length < totalQuestions) {
      alert('Por favor responde todas las preguntas para generar un diagnóstico fiable.');
      return;
    }
    onComplete(answers);
  };

  const isCurrentAnswered = answers[currentQuestion.id] !== undefined;
  const allAnswered = Object.keys(answers).length === totalQuestions;

  return (
    <div className="w-full max-w-3xl mx-auto px-4 py-8">
      {/* Barra de Progreso y Metadatos Superiores */}
      <div className="mb-8">
        <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
          <div className="flex items-center gap-2">
            <span className="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-100 dark:bg-blue-950/80 text-blue-700 dark:text-blue-300">
              {currentQuestion.dimensionLabel}
            </span>
            <button
              type="button"
              onClick={onOpenEthicsModal}
              className="text-xs text-slate-500 hover:text-blue-600 dark:hover:text-blue-400 underline font-medium flex items-center gap-1"
            >
              <span>ℹ️ Fuentes &amp; Metodología</span>
            </button>
          </div>

          <div className="text-right text-xs font-semibold text-slate-500 dark:text-slate-400">
            Pregunta <span className="text-blue-600 dark:text-blue-400 font-bold">{currentQuestionIndex + 1}</span> de {totalQuestions} ({progressPercent}%)
          </div>
        </div>

        {/* Barra de Progreso Visual */}
        <div className="w-full h-2.5 bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden">
          <div
            className="h-full bg-gradient-to-r from-blue-600 to-indigo-600 transition-all duration-300 ease-out"
            style={{ width: `${progressPercent}%` }}
          ></div>
        </div>
      </div>

      {/* Tarjeta de la Pregunta Actual */}
      <div className="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 sm:p-10 shadow-xl mb-6 relative">
        <div className="mb-6">
          <div className="text-xs font-extrabold text-blue-600 dark:text-blue-400 uppercase tracking-widest mb-2">
            PASO {currentQuestionIndex + 1}
          </div>
          <h2 className="text-xl sm:text-2xl font-heading font-extrabold text-slate-900 dark:text-white leading-snug">
            {currentQuestion.question}
          </h2>
          {currentQuestion.contextTip && (
            <p className="text-xs sm:text-sm text-slate-500 dark:text-slate-400 italic mt-2">
              💡 {currentQuestion.contextTip}
            </p>
          )}
        </div>

        {/* Lista de Opciones */}
        <div className="space-y-3">
          {currentQuestion.options.map((option) => {
            const isSelected = answers[currentQuestion.id] === option.key;
            const profile = RIASEC_PROFILES[option.key];

            return (
              <button
                key={option.key}
                type="button"
                onClick={() => handleSelectOption(option.key)}
                className={`w-full text-left p-4 sm:p-5 rounded-2xl border transition-all duration-200 flex items-start gap-4 ${
                  isSelected
                    ? 'border-blue-600 bg-blue-50/80 dark:bg-blue-950/40 shadow-md ring-2 ring-blue-500/20'
                    : 'border-slate-200 dark:border-slate-800/80 hover:border-slate-300 dark:hover:border-slate-700 bg-white dark:bg-slate-900/50 hover:bg-slate-50 dark:hover:bg-slate-800/30'
                }`}
              >
                <div
                  className={`w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold shrink-0 mt-0.5 transition ${
                    isSelected
                      ? 'bg-blue-600 text-white'
                      : 'border-2 border-slate-300 dark:border-slate-700 text-slate-400'
                  }`}
                >
                  {isSelected ? '✓' : ''}
                </div>

                <div className="flex-1">
                  <p className="text-sm sm:text-base font-medium text-slate-800 dark:text-slate-200 leading-relaxed">
                    {option.text}
                  </p>
                </div>
              </button>
            );
          })}
        </div>

        {/* Ajuste de avance automático */}
        <div className="flex items-center justify-between mt-6 pt-4 border-t border-slate-100 dark:border-slate-800 text-xs text-slate-400">
          <label className="inline-flex items-center gap-2 cursor-pointer select-none">
            <input
              type="checkbox"
              checked={isAutoAdvance}
              onChange={(e) => setIsAutoAdvance(e.target.checked)}
              className="rounded border-slate-300 text-blue-600 focus:ring-blue-500"
            />
            <span>Avance automático al seleccionar</span>
          </label>
        </div>
      </div>

      {/* Controles de Navegación */}
      <div className="flex items-center justify-between gap-4">
        <button
          type="button"
          onClick={handlePrev}
          disabled={currentQuestionIndex === 0}
          className={`px-6 py-3 rounded-xl text-sm font-bold border transition flex items-center gap-2 ${
            currentQuestionIndex === 0
              ? 'opacity-0 pointer-events-none'
              : 'border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800'
          }`}
        >
          ← Anterior
        </button>

        {currentQuestionIndex < totalQuestions - 1 ? (
          <button
            type="button"
            onClick={handleNext}
            disabled={!isCurrentAnswered}
            className={`px-8 py-3 rounded-xl text-sm font-bold transition flex items-center gap-2 ${
              isCurrentAnswered
                ? 'bg-blue-600 hover:bg-blue-700 text-white shadow-lg shadow-blue-600/25'
                : 'bg-slate-200 dark:bg-slate-800 text-slate-400 cursor-not-allowed'
            }`}
          >
            <span>Siguiente</span>
            <span>→</span>
          </button>
        ) : (
          <button
            type="button"
            onClick={handleSubmit}
            disabled={!allAnswered}
            className={`px-9 py-3.5 rounded-xl text-sm font-extrabold transition flex items-center gap-2 ${
              allAnswered
                ? 'bg-gradient-to-r from-amber-500 to-amber-400 text-slate-950 shadow-xl shadow-amber-400/20 hover:scale-[1.02]'
                : 'bg-slate-200 dark:bg-slate-800 text-slate-400 cursor-not-allowed'
            }`}
          >
            <span>🎯 Finalizar y Ver Resultados</span>
          </button>
        )}
      </div>
    </div>
  );
};
