<script src="https://cdn.tailwindcss.com"></script>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6 text-center">{{ $quiz->titre }}</h1>

    <div id="statistiques" class="flex justify-between mb-6 text-lg font-medium">
        <div id="question-count">Question 1 / {{ count($questions) }}</div>
        <div id="score-count">Score : 0 / 10</div>
    </div>

    @foreach($questions as $index => $question)
        <div class="mb-6 p-4 border rounded shadow question-block"
             data-correct="{{ trim($question->reponseCorrecte) }}"
             id="question-{{ $index }}">
            <p class="font-semibold mb-2">{{ $question->question }}</p>
            <ul class="space-y-2">
                @foreach (explode(',', $question->reponses) as $reponse)
                    <li>
                        <button 
                            class="reponse w-full text-left p-2 border rounded hover:bg-gray-100 transition"
                            data-reponse="{{ trim($reponse) }}"
                        >
                            {{ trim($reponse) }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach

    <div id="final-message" class="text-center text-xl font-bold text-green-600 mt-8 hidden">
        Quiz terminé ! Score final : <span id="final-score"></span>/10
    </div>
</div>

<script>
    let totalQuestions = document.querySelectorAll('.question-block').length;
    let currentQuestion = 0;
    let score = 0;

    const questionCountEl = document.getElementById('question-count');
    const scoreCountEl = document.getElementById('score-count');
    const finalMessageEl = document.getElementById('final-message');
    const finalScoreEl = document.getElementById('final-score');

    document.querySelectorAll('.question-block').forEach((block, index) => {
        const correctAnswer = block.dataset.correct?.trim().toLowerCase();
        const buttons = block.querySelectorAll('.reponse');

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                if (block.classList.contains('done')) return;

                const selected = btn.dataset.reponse?.trim().toLowerCase();
                currentQuestion++;

                buttons.forEach(b => {
                    const rep = b.dataset.reponse?.trim().toLowerCase();
                    if (rep === correctAnswer) {
                        b.classList.add('bg-green-200', 'border-green-500', 'text-green-800');
                    }
                });

                if (selected !== correctAnswer) {
                    btn.classList.add('bg-red-200', 'border-red-500', 'text-red-800');
                } else {
                    score++;
                    btn.classList.add('bg-green-200', 'border-green-500', 'text-green-800');
                    block.classList.add('border-green-400', 'bg-green-50');
                }

                block.classList.add('done');
                buttons.forEach(b => b.disabled = true);

                let score10 = Math.round((score / totalQuestions) * 10);
                questionCountEl.textContent = `Question ${currentQuestion} / ${totalQuestions}`;
                scoreCountEl.textContent = `Score : ${score10} / 10`;

                if (currentQuestion === totalQuestions) {
                    finalScoreEl.textContent = score10;
                    finalMessageEl.classList.remove('hidden');
                }
            });
        });
    });
</script>
