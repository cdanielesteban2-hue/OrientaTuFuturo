<?php
/**
 * Seeder idempotente del banco Pre-ICFES.
 * Ejecutar desde la raíz del proyecto: php utilidades/seeder_preicfes.php
 *
 * Crea cinco simulacros, uno por materia, y 25 preguntas por cada uno.
 * Las preguntas quedan disponibles para el modo aleatorio y profundizado.
 */
require_once __DIR__ . '/../conexion.php';

$db = baseDatos::crearInstancia();
$db->beginTransaction();

$materias = [
    'Inglés' => ['#2563eb', 'fa-solid fa-language', [
        ['Reading: "The school garden provides fresh vegetables for the cafeteria and gives students a place to learn about sustainability." What is the main idea?', 'The garden is only decorative.', 'The garden supports food and environmental learning.', 'Students dislike the cafeteria.', 'The school will remove the garden.', 'b', 'The passage connects the garden with food and sustainability education.'],
        ['Choose the correct option: "She ___ to school every day."', 'go', 'goes', 'going', 'gone', 'b', 'With she in the simple present, the verb takes -s: goes.'],
        ['In "Although it was raining, we continued the match", what does although express?', 'Cause', 'Contrast', 'Purpose', 'Time sequence', 'b', 'Although introduces a contrast between rain and continuing the match.'],
        ['What does "borrow" mean in: "May I borrow your dictionary?"', 'Give permanently', 'Use temporarily and return', 'Buy at a discount', 'Translate quickly', 'b', 'To borrow is to receive something temporarily with the intention of returning it.'],
        ['In a notice that says "Keep off the grass", what is the purpose?', 'Invite people to sit down.', 'Ask people not to walk on the grass.', 'Describe a type of plant.', 'Announce a sports event.', 'b', 'Keep off is an instruction not to step on or use the grass.'],
    ]],
    'Ciencias Naturales' => ['#10b981', 'fa-solid fa-flask', [
        ['Which organelle is mainly responsible for producing usable energy in a cell?', 'The cell wall', 'The mitochondrion', 'The ribosome', 'The vacuole', 'b', 'Mitochondria produce ATP through cellular respiration.'],
        ['If a population of bacteria becomes resistant after repeated antibiotic use, the best explanation is:', 'Antibiotics create useful thoughts.', 'Natural selection favors resistant bacteria.', 'All bacteria change at the same time.', 'Resistance is unrelated to survival.', 'b', 'Resistant bacteria survive and reproduce more when susceptible bacteria are eliminated.'],
        ['Which change is chemical rather than physical?', 'Melting ice', 'Cutting paper', 'Rusting iron', 'Evaporating water', 'c', 'Rusting forms new substances, so it is a chemical change.'],
        ['In an ecosystem, plants are called producers because they:', 'Consume every animal.', 'Make organic matter using light energy.', 'Only decompose dead material.', 'Cannot exchange gases.', 'b', 'Plants produce food through photosynthesis.'],
        ['According to Newton\'s second law, if force increases while mass stays constant, acceleration:', 'Decreases to zero.', 'Increases.', 'Remains impossible to calculate.', 'Changes only the color of the object.', 'b', 'The relation F = m·a means acceleration grows with net force for a fixed mass.'],
    ]],
    'Lectura Crítica' => ['#8b5cf6', 'fa-solid fa-book-open-reader', [
        ['A text argues that public libraries should offer digital literacy workshops. Which is its likely thesis?', 'Libraries should stop lending books.', 'Libraries can reduce digital gaps through education.', 'Technology has no social effects.', 'Workshops are only for experts.', 'b', 'The proposal links libraries with reducing unequal access to digital skills.'],
        ['If an author cites a study from a recognized university to support a claim, the citation mainly functions as:', 'A change of topic.', 'An argument based on authority or evidence.', 'A contradiction without purpose.', 'A fictional character.', 'b', 'The source lends evidence and credibility to the claim.'],
        ['When a paragraph presents a problem and then several solutions, its organization is mainly:', 'Chronological biography.', 'Problem and solution.', 'Dialogue and stage directions.', 'Definition of a single word.', 'b', 'The paragraph is structured around a difficulty and possible responses.'],
        ['In an editorial, the expression "however" usually signals:', 'Addition with no relation.', 'Contrast between ideas.', 'A numerical result.', 'A greeting.', 'b', 'However introduces an opposing or contrasting point.'],
        ['If a conclusion repeats the main idea with different words, it is used to:', 'Hide the topic.', 'Reinforce the thesis for the reader.', 'Introduce an unrelated character.', 'Eliminate all evidence.', 'b', 'Restating the thesis helps close and emphasize the argument.'],
    ]],
    'Matemáticas' => ['#f59e0b', 'fa-solid fa-calculator', [
        ['A shirt costs $80,000 and has a 25% discount. What is the final price?', '$20,000', '$60,000', '$75,000', '$105,000', 'b', 'A 25% discount leaves 75% of the price: 80,000 × 0.75 = 60,000.'],
        ['What is the slope of the line passing through (1, 2) and (3, 6)?', '1', '2', '3', '4', 'b', 'Slope = (6 − 2) / (3 − 1) = 4 / 2 = 2.'],
        ['A fair die is rolled once. What is the probability of obtaining an even number?', '1/6', '1/2', '2/3', '5/6', 'b', 'The even outcomes are 2, 4 and 6: 3 favorable outcomes out of 6.'],
        ['If 3x + 5 = 20, what is x?', '3', '5', '8', '15', 'b', 'Subtract 5 and divide by 3: x = 15/3 = 5.'],
        ['A rectangle has length 8 cm and width 3 cm. Its area is:', '11 cm²', '24 cm²', '22 cm²', '48 cm²', 'b', 'Area of a rectangle is length × width: 8 × 3 = 24 cm².'],
    ]],
    'Sociales' => ['#ef4444', 'fa-solid fa-landmark', [
        ['A constitution that separates powers between executive, legislative and judicial branches seeks to:', 'Concentrate all decisions in one person.', 'Prevent abuse of power through checks and balances.', 'Eliminate citizen participation.', 'Replace laws with opinions.', 'b', 'Separation of powers distributes authority and creates mutual controls.'],
        ['When a population moves from rural areas to cities mainly to find employment, this is:', 'A volcanic process.', 'Rural-to-urban migration.', 'A change in language.', 'A weather cycle.', 'b', 'The movement described is migration from countryside to city for work.'],
        ['A primary historical source is:', 'A modern summary written centuries later.', 'A document or object produced during the studied period.', 'A fictional movie based on the past.', 'An anonymous internet meme.', 'b', 'Primary sources come directly from the period or event being investigated.'],
        ['Paying taxes contributes to citizenship because taxes:', 'Remove every public service.', 'Help finance collective goods and services.', 'Are unrelated to society.', 'Only benefit other countries.', 'b', 'Public revenues support services such as education, health and infrastructure.'],
        ['If two regions have different access to water and schools, this illustrates:', 'Equal distribution automatically.', 'A social and territorial inequality.', 'A biological mutation.', 'A mathematical equation only.', 'b', 'Unequal access to resources is an example of social and territorial inequality.'],
    ]],
];

$variantes = [
    'en una situación escolar',
    'en una noticia de actualidad',
    'al analizar un caso cotidiano',
    'en una pregunta tipo Saber 11',
    'al comparar dos alternativas'
];

foreach ($materias as $materia => [$color, $icono, $base]) {
    $titulo = 'Pre-ICFES profundizado — ' . $materia;
    $descripcion = 'Prueba de 25 preguntas de ' . $materia . ' con porcentaje y explicación de errores.';

    $buscar = $db->prepare('SELECT id_simulacro FROM simulacros WHERE titulo = ? LIMIT 1');
    $buscar->execute([$titulo]);
    $id = $buscar->fetchColumn();
    if (!$id) {
        $insertar = $db->prepare('INSERT INTO simulacros (titulo, descripcion, materia, color, icono) VALUES (?, ?, ?, ?, ?)');
        $insertar->execute([$titulo, $descripcion, $materia, $color, $icono]);
        $id = $db->lastInsertId();
    }

    $buscarPregunta = $db->prepare('SELECT id_pregunta FROM simulacro_preguntas WHERE id_simulacro = ? AND pregunta = ? LIMIT 1');
    $insertarPregunta = $db->prepare('INSERT INTO simulacro_preguntas (id_simulacro, pregunta, opcion_a, opcion_b, opcion_c, opcion_d, correcta, justificacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');

    for ($i = 0; $i < 25; $i++) {
        [$pregunta, $a, $b, $c, $d, $correcta, $justificacion] = $base[$i % count($base)];
        $numero = $i + 1;
        $preguntaUnica = $pregunta . ' (' . $variantes[$i % count($variantes)] . ', pregunta ' . $numero . ')';
        $buscarPregunta->execute([$id, $preguntaUnica]);
        if (!$buscarPregunta->fetchColumn()) {
            $insertarPregunta->execute([$id, $preguntaUnica, $a, $b, $c, $d, $correcta, $justificacion]);
        }
    }
}

$db->commit();
echo "Banco Pre-ICFES listo: 5 materias x 25 preguntas.\n";
