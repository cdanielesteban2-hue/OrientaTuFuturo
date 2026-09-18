<?php
/** @var array $cuestionario */
/** @var array $preguntas */
/** @var string $error */
$url_base = defined('URL_BASE') ? constant('URL_BASE') : '';
?>
<div class="test-container">
    <div style="margin-bottom: 20px; text-align: center;">
        <span class="badge badge-primary"><i class="fa-solid fa-clipboard-question"></i> Test Vocacional</span>
        <h1 style="font-size: 2.2rem; margin-top: 5px;"><?php echo htmlspecialchars($cuestionario['descripcion']); ?></h1>
        <p style="color: var(--text-secondary);">Selecciona la opción con la que más te identifiques en cada caso.</p>
    </div>

    <!-- Barra de Progreso de Pasos Interactiva -->
    <div class="progress-step-wrapper">
        <div class="progress-step-text">
            <span id="step-indicator" style="font-weight: 700;">Pregunta 1 de <?php echo count($preguntas); ?></span>
            <span id="step-percentage" style="color: var(--text-secondary); font-size: 0.85rem;">0% Completado</span>
        </div>
        <div class="progress-bar-bg" style="height: 8px; margin-top: 5px;">
            <div class="progress-bar-fill" id="progress-fill" style="width: 0%; background-color: var(--primary); height: 100%; transition: var(--transition);"></div>
        </div>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert-error" style="max-width: 750px; margin: 0 auto 20px auto;">
            <i class="fa-solid fa-circle-exclamation"></i> <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo $url_base; ?>cuestionarios/resolver?id=<?php echo $cuestionario['id_cuestionario']; ?>">
        <?php $num = 1; ?>
        <?php foreach ($preguntas as $preg): ?>
            <div class="question-card question-card-slider" id="q_card_<?php echo $preg['id_pregunta']; ?>">
                <div class="question-text">
                    <span style="color: var(--primary); font-family: var(--font-heading); font-size: 1.3rem; margin-right: 5px;"><?php echo $num++; ?>.</span> 
                    <?php echo htmlspecialchars($preg['pregunta']); ?>
                </div>
                
                <div class="options-list">
                    <div class="option-item" onclick="selectOption(this, '<?php echo $preg['id_pregunta']; ?>')">
                        <input type="radio" name="respuestas[<?php echo $preg['id_pregunta']; ?>]" value="a">
                        <span><?php echo htmlspecialchars($preg['a']); ?></span>
                    </div>

                    <div class="option-item" onclick="selectOption(this, '<?php echo $preg['id_pregunta']; ?>')">
                        <input type="radio" name="respuestas[<?php echo $preg['id_pregunta']; ?>]" value="b">
                        <span><?php echo htmlspecialchars($preg['b']); ?></span>
                    </div>

                    <div class="option-item" onclick="selectOption(this, '<?php echo $preg['id_pregunta']; ?>')">
                        <input type="radio" name="respuestas[<?php echo $preg['id_pregunta']; ?>]" value="c">
                        <span><?php echo htmlspecialchars($preg['c']); ?></span>
                    </div>

                    <div class="option-item" onclick="selectOption(this, '<?php echo $preg['id_pregunta']; ?>')">
                        <input type="radio" name="respuestas[<?php echo $preg['id_pregunta']; ?>]" value="d">
                        <span><?php echo htmlspecialchars($preg['d']); ?></span>
                    </div>

                    <?php if (!empty($preg['e'])): ?>
                    <div class="option-item" onclick="selectOption(this, '<?php echo $preg['id_pregunta']; ?>')">
                        <input type="radio" name="respuestas[<?php echo $preg['id_pregunta']; ?>]" value="e">
                        <span><?php echo htmlspecialchars($preg['e']); ?></span>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($preg['f'])): ?>
                    <div class="option-item" onclick="selectOption(this, '<?php echo $preg['id_pregunta']; ?>')">
                        <input type="radio" name="respuestas[<?php echo $preg['id_pregunta']; ?>]" value="f">
                        <span><?php echo htmlspecialchars($preg['f']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Controles del Slider -->
        <div style="display: flex; justify-content: space-between; align-items: center; max-width: 600px; margin: 30px auto; gap: 15px;">
            <button type="button" id="btn-prev" class="btn btn-outline" onclick="prevStep()">
                <i class="fa-solid fa-arrow-left"></i> Anterior
            </button>
            <button type="button" id="btn-next" class="btn btn-primary" onclick="nextStep()">
                Siguiente <i class="fa-solid fa-arrow-right"></i>
            </button>
            <button type="submit" id="btn-submit" class="btn btn-accent" style="display: none; padding: 12px 35px; font-weight: 700; box-shadow: var(--shadow-premium);">
                <i class="fa-solid fa-circle-check"></i> Finalizar y Ver Resultados
            </button>
        </div>
    </form>
</div>

<script>
let currentStep = 0;
const cards = document.querySelectorAll('.question-card-slider');
const totalSteps = cards.length;

function showStep(stepIndex) {
    cards.forEach((card, idx) => {
        if (idx === stepIndex) {
            card.classList.add('active');
        } else {
            card.classList.remove('active');
        }
    });

    // Actualizar indicador textual y de porcentaje
    document.getElementById('step-indicator').textContent = `Pregunta ${stepIndex + 1} de ${totalSteps}`;
    const percent = Math.round(((stepIndex + 1) / totalSteps) * 100);
    document.getElementById('step-percentage').textContent = `${percent}% Completado`;
    document.getElementById('progress-fill').style.width = `${percent}%`;

    // Controlar visibilidad del botón Anterior
    if (stepIndex === 0) {
        document.getElementById('btn-prev').style.visibility = 'hidden';
    } else {
        document.getElementById('btn-prev').style.visibility = 'visible';
    }

    // Controlar visibilidad y alternancia entre Siguiente y Finalizar
    if (stepIndex === totalSteps - 1) {
        document.getElementById('btn-next').style.display = 'none';
        document.getElementById('btn-submit').style.display = 'inline-flex';
    } else {
        document.getElementById('btn-next').style.display = 'inline-flex';
        document.getElementById('btn-submit').style.display = 'none';
    }

    // Habilitar/deshabilitar controles según si la pregunta actual ya fue respondida
    checkAnswered(stepIndex);
}

function checkAnswered(stepIndex) {
    const currentCard = cards[stepIndex];
    const radios = currentCard.querySelectorAll('input[type="radio"]');
    let isAnswered = false;
    radios.forEach(radio => {
        if (radio.checked) {
            isAnswered = true;
        }
    });

    if (stepIndex === totalSteps - 1) {
        document.getElementById('btn-submit').disabled = !isAnswered;
    } else {
        document.getElementById('btn-next').disabled = !isAnswered;
    }
}

function nextStep() {
    if (currentStep < totalSteps - 1) {
        currentStep++;
        showStep(currentStep);
    }
}

function prevStep() {
    if (currentStep > 0) {
        currentStep--;
        showStep(currentStep);
    }
}

// Función dinámica en JS para estilizar las opciones y gestionar el flujo del slider
function selectOption(element, questionId) {
    // Buscar todos los labels dentro de la pregunta actual y remover la clase 'selected'
    const questionCard = document.getElementById('q_card_' + questionId);
    const options = questionCard.querySelectorAll('.option-item');
    options.forEach(opt => {
        opt.classList.remove('selected');
    });
    
    // Añadir la clase 'selected' al label cliqueado
    element.classList.add('selected');
    
    // Marcar el botón de radio correspondiente
    const radio = element.querySelector('input[type="radio"]');
    if (radio) {
        radio.checked = true;
    }

    // Verificar si ya se respondió para habilitar los botones Siguiente/Finalizar
    checkAnswered(currentStep);

    // Efecto Premium: Avance automático suave de pregunta después de 450ms (si no es la última)
    if (currentStep < totalSteps - 1) {
        setTimeout(() => {
            nextStep();
        }, 450);
    }
}

// Inicializar el test mostrando el primer paso
document.addEventListener('DOMContentLoaded', () => {
    showStep(currentStep);
});
</script>

