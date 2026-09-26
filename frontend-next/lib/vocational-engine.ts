import { RiasecKey, TestResultScore, Career } from '../types/vocational';
import { RIASEC_PROFILES } from '../data/questions';
import { CAREERS_DATABASE } from '../data/careers';

export function calculateVocationalResult(answers: Record<number, RiasecKey>): TestResultScore {
  const scores: Record<RiasecKey, number> = {
    R: 0,
    I: 0,
    A: 0,
    S: 0,
    E: 0,
    C: 0
  };

  const totalAnswers = Object.keys(answers).length;

  // Conteo de respuestas
  Object.values(answers).forEach((key) => {
    if (scores[key] !== undefined) {
      scores[key] += 1;
    }
  });

  // Cálculo de porcentajes
  const percentages: Record<RiasecKey, number> = {
    R: totalAnswers > 0 ? Math.round((scores.R / totalAnswers) * 100) : 0,
    I: totalAnswers > 0 ? Math.round((scores.I / totalAnswers) * 100) : 0,
    A: totalAnswers > 0 ? Math.round((scores.A / totalAnswers) * 100) : 0,
    S: totalAnswers > 0 ? Math.round((scores.S / totalAnswers) * 100) : 0,
    E: totalAnswers > 0 ? Math.round((scores.E / totalAnswers) * 100) : 0,
    C: totalAnswers > 0 ? Math.round((scores.C / totalAnswers) * 100) : 0
  };

  // Ordenar áreas de mayor a menor puntuación
  const sortedKeys = (Object.keys(scores) as RiasecKey[]).sort((a, b) => scores[b] - scores[a]);

  const topAreas = sortedKeys.map((k) => RIASEC_PROFILES[k]);
  const primaryArea = topAreas[0];
  const secondaryArea = topAreas[1];
  const tertiaryArea = topAreas[2];

  // Código Holland de 3 letras (ejemplo: 'RIE')
  const riasecCode = `${primaryArea.key}${secondaryArea.key}${tertiaryArea.key}`;

  // Algoritmo de afinidad de carreras
  const recommendedCareers: Career[] = CAREERS_DATABASE
    .map((career) => {
      let affinityScore = 0;
      if (career.riasecPrimary === primaryArea.key) affinityScore += 60;
      if (career.riasecSecondary === secondaryArea.key) affinityScore += 25;
      if (career.riasecPrimary === secondaryArea.key) affinityScore += 30;
      if (career.riasecSecondary === primaryArea.key) affinityScore += 20;
      if (career.riasecPrimary === tertiaryArea.key) affinityScore += 10;
      return { career, affinityScore };
    })
    .sort((a, b) => b.affinityScore - a.affinityScore)
    .slice(0, 6)
    .map((item) => item.career);

  // Generación de la síntesis diagnóstica inteligente
  const diagnosticRationale = `Tu perfil vocacional dominante es ${primaryArea.name} (${percentages[primaryArea.key]}%), con una fuerte complementariedad hacia el área ${secondaryArea.name} (${percentages[secondaryArea.key]}%), consolidando tu código vocacional Holland: ${riasecCode}. 

Este patrón indica que tus motivaciones intrínsecas se potencian cuando puedes combinar ${primaryArea.tagline.toLowerCase()} junto con ${secondaryArea.tagline.toLowerCase()}. En el contexto educativo colombiano —siguiendo las directrices de autoconocimiento de la Universidad de Medellín (UVirtualAbierta) y la mitigación de deserción universitaria de la Universidad de Santander (UDES)—, tu mayor probabilidad de satisfacción académica y éxito profesional radicará en programas donde la teoría se conecte directamente con la aplicación real y donde puedas desplegar tu talento natural para ${primaryArea.keySkills[0].toLowerCase()} y ${secondaryArea.keySkills[0].toLowerCase()}.`;

  return {
    scores,
    percentages,
    topAreas,
    primaryArea,
    secondaryArea,
    riasecCode,
    recommendedCareers,
    diagnosticRationale,
    completedAt: new Date().toISOString()
  };
}

export const INSTITUTIONAL_RECOGNITION = {
  mandatoryStatement: 'Este test de orientación vocacional se inspira y toma como referencia el Test Vocacional de Filadd (basado en el modelo de John Holland), el Test de Orientación Vocacional de la Universidad de Santander (UDES) y el Test de Orientación Vocacional de la Universidad de Medellín (UVirtualAbierta).',
  methodologyNote: 'La metodología psicométrica se fundamenta en el modelo tipológico hexagonal RIASEC desarrollado por el Dr. John L. Holland, validado internacionalmente para medir congruencia persona-ambiente laboral, complementado con los enfoques institucionales colombianos de la UDES (orientación personalizada por áreas del conocimiento para prevenir la deserción) y de la Universidad de Medellín (recorrido de autoconocimiento para consolidar sueños profesionales).',
  disclaimer: 'Este test es una herramienta de orientación y no reemplaza una asesoría profesional personalizada de un orientador vocacional, psicólogo o pedagogo.'
};
