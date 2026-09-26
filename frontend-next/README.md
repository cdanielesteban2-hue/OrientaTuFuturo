# Orienta tu FUTURO 🎓 - Módulo de Orientación Vocacional (Next.js + Tailwind + TypeScript)

Este módulo implementa el aplicativo moderno de **Orientación Vocacional Universitaria** para estudiantes de grados 10° y 11°, integrando el rigor psicométrico del modelo **John Holland (RIASEC)** y las metodologías institucionales colombianas.

---

## 🏛️ Reconocimiento Institucional de Fuentes (Obligatorio)

> **Cita Formal:**  
> *“Este test de orientación vocacional se inspira y toma como referencia el Test Vocacional de Filadd (basado en el modelo de John Holland), el Test de Orientación Vocacional de la Universidad de Santander (UDES) y el Test de Orientación Vocacional de la Universidad de Medellín (UVirtualAbierta).”*

- **Test Vocacional de Filadd:** Modelo rápido y accesible que cruza respuestas con perfiles de carreras en las 6 áreas ocupacionales:
  1. *Técnica-Práctica (Realista)*
  2. *Científica-Investigativa (Investigador)*
  3. *Artística-Creativa (Artístico)*
  4. *Social-Humanitaria (Social)*
  5. *Empresarial-Comercial (Emprendedor)*
  6. *Administrativa-Organizacional (Convencional)*
- **Universidad de Santander (UDES):** Enfoque psicopedagógico en la personalidad y preferencias del joven para orientar hacia áreas de conocimiento idóneas y mitigar la deserción universitaria en Colombia.
- **Universidad de Medellín (UVirtualAbierta):** Recorrido reflexivo donde el estudiante descubre sus sueños profesionales y consolida su autoconocimiento previo a la matrícula.

> **⚠️ Disclaimer Deontológico:**  
> *“Este test es una herramienta de orientación y no reemplaza una asesoría profesional personalizada de un orientador vocacional, psicólogo o pedagogo.”*

---

## 📁 Estructura del Proyecto

```
frontend-next/
├── app/
│   ├── test-vocacional/
│   │   └── page.tsx              # Página principal con orquestación de estados (Hero -> Wizard -> Results)
│   └── layout.tsx                # Layout global con fuentes y temas
├── components/
│   ├── VocationalHero.tsx         # Portada atractiva con métricas y llamados a la acción
│   ├── VocationalWizard.tsx       # Wizard interactivo con barra de progreso y auto-avance
│   ├── ResultsDashboard.tsx       # Dashboard de resultados con radar RIASEC y carreras
│   ├── CareerCard.tsx             # Tarjeta con empleabilidad, habilidades y universidades
│   ├── RiasecRadarChart.tsx       # Radar SVG responsivo sin dependencias pesadas
│   └── EthicsRecognitionModal.tsx # Modal formal de fuentes y aviso legal
├── data/
│   ├── questions.ts               # Banco de 18 preguntas calibradas en 4 dimensiones
│   └── careers.ts                 # Base de datos de carreras colombianas mapeadas a RIASEC
├── lib/
│   └── vocational-engine.ts       # Algoritmo de afinidad Holland y síntesis diagnóstica
├── types/
│   └── vocational.ts              # Definiciones estrictas de TypeScript
├── package.json
└── README.md
```

---

## 🚀 Instalación y Ejecución

```bash
# 1. Acceder al directorio
cd frontend-next

# 2. Instalar dependencias
npm install

# 3. Iniciar servidor de desarrollo
npm run dev
```

Visita `http://localhost:3000/test-vocacional` en tu navegador.
