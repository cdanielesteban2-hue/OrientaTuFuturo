'use client';

import React from 'react';
import { RiasecKey } from '../types/vocational';
import { RIASEC_PROFILES } from '../data/questions';

interface RiasecRadarChartProps {
  percentages: Record<RiasecKey, number>;
  size?: number;
}

export const RiasecRadarChart: React.FC<RiasecRadarChartProps> = ({ percentages, size = 340 }) => {
  const keys: RiasecKey[] = ['R', 'I', 'A', 'S', 'E', 'C'];
  const center = size / 2;
  const radius = (size / 2) - 45;
  const totalAxes = keys.length;

  // Calcula las coordenadas angulares de cada vértice
  const getCoordinates = (index: number, valuePct: number) => {
    const angle = (Math.PI * 2 / totalAxes) * index - Math.PI / 2;
    const r = (radius * Math.max(valuePct, 8)) / 100;
    const x = center + r * Math.cos(angle);
    const y = center + r * Math.sin(angle);
    return { x, y, angle };
  };

  // Puntos del polígono de datos
  const dataPoints = keys.map((key, i) => getCoordinates(i, percentages[key]));
  const polygonPoints = dataPoints.map((p) => `${p.x},${p.y}`).join(' ');

  // Guías circulares concéntricas (25%, 50%, 75%, 100%)
  const gridLevels = [25, 50, 75, 100];

  return (
    <div className="flex flex-col items-center justify-center p-4 bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 rounded-3xl">
      <svg width={size} height={size} className="overflow-visible max-w-full">
        {/* Círculos o Polígonos de Fondo de la Cuadrícula */}
        {gridLevels.map((lvl) => {
          const gridPoints = keys.map((_, i) => getCoordinates(i, lvl)).map((p) => `${p.x},${p.y}`).join(' ');
          return (
            <polygon
              key={lvl}
              points={gridPoints}
              fill="none"
              stroke="currentColor"
              className="text-slate-200 dark:text-slate-800"
              strokeWidth="1"
              strokeDasharray={lvl === 100 ? 'none' : '3 3'}
            />
          );
        })}

        {/* Ejes Radiales desde el centro */}
        {keys.map((_, i) => {
          const outer = getCoordinates(i, 100);
          return (
            <line
              key={i}
              x1={center}
              y1={center}
              x2={outer.x}
              y2={outer.y}
              stroke="currentColor"
              className="text-slate-200 dark:text-slate-800"
              strokeWidth="1"
            />
          );
        })}

        {/* Polígono de Datos del Estudiante */}
        <polygon
          points={polygonPoints}
          fill="rgba(37, 99, 235, 0.25)"
          stroke="#2563eb"
          strokeWidth="2.5"
          className="transition-all duration-700 ease-out"
        />

        {/* Puntos de datos y etiquetas */}
        {keys.map((key, i) => {
          const p = dataPoints[i];
          const labelCoord = getCoordinates(i, 118);
          const profile = RIASEC_PROFILES[key];
          const val = percentages[key];

          return (
            <g key={key}>
              <circle
                cx={p.x}
                cy={p.y}
                r="4.5"
                fill={profile.color}
                stroke="#ffffff"
                strokeWidth="2"
              />
              <text
                x={labelCoord.x}
                y={labelCoord.y}
                textAnchor="middle"
                dominantBaseline="central"
                className="text-[11px] font-bold fill-slate-700 dark:fill-slate-200"
              >
                {key} ({val}%)
              </text>
            </g>
          );
        })}
      </svg>

      <div className="flex flex-wrap justify-center gap-2 mt-4 text-[10px] sm:text-xs">
        {keys.map((k) => (
          <span key={k} className="inline-flex items-center gap-1 text-slate-600 dark:text-slate-400">
            <span className="w-2.5 h-2.5 rounded-full" style={{ backgroundColor: RIASEC_PROFILES[k].color }}></span>
            <strong>{k}:</strong> {RIASEC_PROFILES[k].shortName}
          </span>
        ))}
      </div>
    </div>
  );
};
