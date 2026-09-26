export type RiasecKey = 'R' | 'I' | 'A' | 'S' | 'E' | 'C';

export interface RiasecProfile {
  key: RiasecKey;
  letter: string;
  name: string;
  shortName: string;
  filaddArea: string;
  color: string;
  bgLight: string;
  icon: string;
  tagline: string;
  description: string;
  keySkills: string[];
  workEnvironments: string[];
  studyHabits: string;
}

export type QuestionDimension = 'intereses' | 'habilidades' | 'habitos' | 'estilo_vida';

export interface QuestionOption {
  key: RiasecKey;
  text: string;
  icon?: string;
  secondaryTag?: string;
}

export interface Question {
  id: number;
  dimension: QuestionDimension;
  dimensionLabel: string;
  question: string;
  contextTip?: string;
  options: QuestionOption[];
}

export interface Career {
  id: string;
  name: string;
  area: string;
  riasecPrimary: RiasecKey;
  riasecSecondary: RiasecKey;
  degreeType: 'Universitario' | 'Tecnológico' | 'Técnico Profesional';
  durationSemesters: number;
  employabilityRate: number; // e.g. 91%
  demandLevel: 'Muy Alta' | 'Alta' | 'Media-Alta';
  salaryRangeColombia: string;
  requiredSkills: string[];
  universitiesColombia: string[];
  whyItFits: string;
}

export interface TestResultScore {
  scores: Record<RiasecKey, number>;
  percentages: Record<RiasecKey, number>;
  topAreas: RiasecProfile[];
  primaryArea: RiasecProfile;
  secondaryArea: RiasecProfile;
  riasecCode: string; // e.g., 'RIE'
  recommendedCareers: Career[];
  diagnosticRationale: string;
  completedAt: string;
}
