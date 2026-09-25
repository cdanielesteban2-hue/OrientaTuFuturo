"""
====================================================================
 test_normalizer.py — Pruebas unitarias para el módulo de scraping
====================================================================
Valida que las funciones de extracción, limpieza y transformación
de datos funcionen exactamente de acuerdo con los requerimientos.

Ejecutar con:
    python -m unittest test_normalizer.py
"""

import unittest
from normalizer import (
    clean_price,
    clean_duration,
    infer_area,
    slugify,
    normalize_program_record,
)


class TestNormalizer(unittest.TestCase):

    def test_clean_price_formats(self):
        """Prueba diversas variaciones de formato de precios en pesos colombianos."""
        # Formatos comunes
        self.assertEqual(clean_price("$ 12.500.000"), 12500000)
        self.assertEqual(clean_price("$12.500.000 COP"), 12500000)
        self.assertEqual(clean_price("COP 4.850.000 / semestre"), 4850000)
        self.assertEqual(clean_price("3.500.000"), 3500000)
        
        # Universidad pública / matricula cero / gratuita
        self.assertEqual(clean_price("Gratuita"), 0)
        self.assertEqual(clean_price("Matrícula Cero / Pública"), 0)
        self.assertEqual(clean_price("0"), 0)
        
        # Casos nulos o vacíos
        self.assertIsNone(clean_price(None))
        self.assertIsNone(clean_price("Por definir"))
        self.assertIsNone(clean_price(""))

    def test_clean_duration_formats(self):
        """Prueba extracción de duración en semestres."""
        self.assertEqual(clean_duration("10 semestres"), 10)
        self.assertEqual(clean_duration("Duración: 8 semestres académicos"), 8)
        self.assertEqual(clean_duration("5 años"), 10)  # 5 años * 2 semestres = 10
        self.assertEqual(clean_duration("4 años"), 8)
        self.assertEqual(clean_duration("12"), 12)
        
        # Valores límite o inválidos
        self.assertIsNone(clean_duration(None))
        self.assertIsNone(clean_duration("No especificada"))
        self.assertIsNone(clean_duration("99 semestres"))  # Supera límite razonable

    def test_infer_area(self):
        """Prueba la categorización heurística de programas por nombre."""
        self.assertEqual(infer_area("Ingeniería de Sistemas y Computación"), "Ingeniería")
        self.assertEqual(infer_area("Medicina Veterinaria y Zootecnia"), "Salud")
        self.assertEqual(infer_area("Administración de Empresas"), "Administración")
        self.assertEqual(infer_area("Derecho y Ciencias Políticas"), "Ciencias Sociales")
        self.assertEqual(infer_area("Diseño Gráfico y Multimedia"), "Artes")
        self.assertEqual(infer_area("Licenciatura en Matemáticas"), "Educación")
        self.assertEqual(infer_area("Carrera Desconocida X"), "General")

    def test_slugify(self):
        """Prueba la generación de slugs limpios para URLs y claves únicas."""
        self.assertEqual(
            slugify("Ingeniería de Sistemas (Diurna)"),
            "ingenieria-de-sistemas-diurna"
        )
        self.assertEqual(
            slugify("Comunicación Social & Periodismo - UdeA"),
            "comunicacion-social-periodismo-udea"
        )

    def test_normalize_program_record(self):
        """Prueba la normalización integral de un registro completo extraído."""
        raw_data = {
            "nombre": "  Ingeniería Civil  ",
            "duracion": "10 semestres",
            "costo": "$ 5.600.000 / semestre",
            "modalidad": "presencial",
            "sede": "Medellín",
            "descripcion": "Programa de ingeniería enfocado en infraestructura.",
        }
        
        normalized = normalize_program_record(raw_data, id_universidad=1)
        
        self.assertEqual(normalized["id_universidad"], 1)
        self.assertEqual(normalized["nombre"], "Ingeniería Civil")
        self.assertEqual(normalized["duracion_semestres"], 10)
        self.assertEqual(normalized["costo_semestre"], 5600000)
        self.assertEqual(normalized["modalidad"], "Presencial")
        self.assertEqual(normalized["area"], "Ingeniería")


if __name__ == "__main__":
    unittest.main()
