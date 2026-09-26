'use client';

import React, { useState } from 'react';
import { VocationalHero } from '../../components/VocationalHero';
import { VocationalWizard } from '../../components/VocationalWizard';
import { ResultsDashboard } from '../../components/ResultsDashboard';
import { EthicsRecognitionModal } from '../../components/EthicsRecognitionModal';
import { calculateVocationalResult } from '../../lib/vocational-engine';
import { RiasecKey, TestResultScore } from '../../types/vocational';

type TestStage = 'intro' | 'testing' | 'results';

export default function TestVocacionalPage() {
  const [stage, setStage] = useState<TestStage>('intro');
  const [results, setResults] = useState<TestResultScore | null>(null);
  const [isEthicsModalOpen, setIsEthicsModalOpen] = useState<boolean>(false);

  const handleStart = () => {
    setStage('testing');
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  const handleComplete = (answers: Record<number, RiasecKey>) => {
    const calculated = calculateVocationalResult(answers);
    setResults(calculated);
    setStage('results');
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  const handleRestart = () => {
    setResults(null);
    setStage('intro');
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  return (
    <div className="min-h-screen bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 transition-colors duration-200">
      {/* Modal Institucional de Ética y Reconocimientos */}
      <EthicsRecognitionModal
        isOpen={isEthicsModalOpen}
        onClose={() => setIsEthicsModalOpen(false)}
      />

      {/* Contenido según la etapa del flujo de usuario */}
      {stage === 'intro' && (
        <VocationalHero
          onStart={handleStart}
          onOpenEthicsModal={() => setIsEthicsModalOpen(true)}
        />
      )}

      {stage === 'testing' && (
        <VocationalWizard
          onComplete={handleComplete}
          onOpenEthicsModal={() => setIsEthicsModalOpen(true)}
        />
      )}

      {stage === 'results' && results && (
        <ResultsDashboard
          results={results}
          onRestart={handleRestart}
          onOpenEthicsModal={() => setIsEthicsModalOpen(true)}
        />
      )}
    </div>
  );
}
