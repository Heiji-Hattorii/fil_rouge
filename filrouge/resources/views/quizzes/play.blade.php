<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Anime & Manga</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-image: url('https://readdy.ai/api/search-image?query=anime%20manga%20background%20with%20subtle%20japanese%20patterns%2C%20dark%20purple%20and%20blue%20gradient%2C%20minimalist%20design%2C%20not%20too%20busy%2C%20perfect%20for%20quiz%20website%20background%2C%20high%20quality%20digital%20art&width=1920&height=1080&seq=bg1&orientation=landscape');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
        }
        .quiz-container {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
        }
        .progress-bar {
            transition: width 0.5s ease-in-out;
        }
        .question-block {
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(20px);
        }
        .question-block.active {
            opacity: 1;
            transform: translateY(0);
        }
        .reponse {
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }
        .reponse:hover {
            transform: translateY(-2px);
        }
        .reponse.correct {
            background-color: rgba(76, 175, 80, 0.2);
            border-color: #4CAF50;
            color: #1e5620;
        }
        .reponse.incorrect {
            background-color: rgba(244, 67, 54, 0.2);
            border-color: #F44336;
            color: #7f1d16;
        }
        .reponse.correct::after, .reponse.incorrect::after {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
        .reponse.correct::after {
            content: "✓";
        }
        .reponse.incorrect::after {
            content: "✗";
        }
        .hexagon {
            clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: var(--color);
            opacity: 0;
            animation: confetti-fall 3s ease-in-out forwards;
        }
        @keyframes confetti-fall {
            0% {
                transform: translateY(-100px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(500px) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>
<body class="min-h-screen">
@include('partials.header')

    <header class="bg-gradient-to-r from-[#6C63FF]/90 to-[#FF6B8B]/90 py-4 shadow-lg">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <h1 class="font-['Pacifico'] text-white text-3xl">AnimeQuiz</h1>
            <div class="flex items-center space-x-4">
                <a href="#" class="text-white hover:text-white/80 transition">Accueil</a>
                <a href="#" class="text-white hover:text-white/80 transition">Quizzes</a>
                <a href="#" class="text-white hover:text-white/80 transition">Classement</a>
            </div>
        </div>
    </header>
    <main class="container mx-auto px-4 py-8">
        <div class="quiz-container rounded-2xl shadow-2xl p-6 md:p-8 max-w-4xl mx-auto mb-12">
            <h1 class="text-3xl md:text-4xl font-bold mb-8 text-center bg-gradient-to-r from-[#6C63FF] to-[#FF6B8B] bg-clip-text text-transparent">{{ $quiz->titre }}</h1>
            
            <div class="mb-8">
                <div class="flex justify-between items-center mb-2">
                    <div id="question-count" class="text-lg font-bold text-gray-700">Question <span id="current-question">1</span> / {{ count($questions) }}</div>
                    <div id="score-count" class="bg-gradient-to-r from-[#6C63FF] to-[#FF6B8B] text-white py-2 px-4 rounded-full font-bold">Score: <span id="current-score">0</span>/10</div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-6">
                    <div id="progress-bar" class="progress-bar bg-gradient-to-r from-[#6C63FF] to-[#FF6B8B] h-2.5 rounded-full" style="width: 0%"></div>
                </div>
            </div>

            @foreach($questions as $index => $question)
                <div class="mb-8 p-6 border-2 border-gray-200 rounded-xl shadow-lg question-block {{ $index === 0 ? 'active' : 'hidden' }}"
                     data-correct="{{ trim($question->reponseCorrecte) }}"
                     id="question-{{ $index }}">
                    <div class="bg-gray-50 -mx-6 -mt-6 p-4 mb-6 rounded-t-xl border-b-2 border-gray-200">
                        <p class="font-bold text-xl md:text-2xl text-gray-800">{{ $question->question }}</p>
                    </div>
                    <ul class="space-y-3">
                        @foreach (explode(',', $question->reponses) as $reponse)
                            <li>
                                <button
                                    class="reponse w-full text-left p-4 border-2 border-gray-300 rounded-lg hover:bg-gray-50 hover:border-[#6C63FF] transition flex justify-between items-center"
                                    data-reponse="{{ trim($reponse) }}"
                                >
                                    <span class="font-medium text-lg">{{ trim($reponse) }}</span>
                                    <span class="response-icon opacity-0 transition-opacity duration-300"></span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    <div class="feedback-message mt-4 p-4 rounded-lg hidden"></div>
                </div>
            @endforeach

            <div id="final-message" class="text-center hidden">
                <div class="confetti-container relative w-full h-40"></div>
                <div class="bg-white p-8 rounded-xl shadow-xl border-2 border-[#6C63FF]">
                    <div class="w-20 h-20 mx-auto bg-gradient-to-r from-[#6C63FF] to-[#FF6B8B] rounded-full flex items-center justify-center mb-4">
                        <i class="ri-trophy-line ri-2x text-white"></i>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-bold mb-4">Quiz Terminé!</h2>
                    <p class="text-xl mb-6">Votre score final: <span id="final-score" class="font-bold text-[#6C63FF] text-2xl">0</span>/10</p>
                    <div class="flex flex-col md:flex-row justify-center gap-4">
                        <button onclick="location.reload()" class="bg-[#6C63FF] text-white py-3 px-6 rounded-button font-bold hover:bg-[#6C63FF]/90 transition flex items-center justify-center whitespace-nowrap">
                            <i class="ri-refresh-line mr-2"></i> Rejouer
                        </button>
                        <button class="bg-[#FF6B8B] text-white py-3 px-6 rounded-button font-bold hover:bg-[#FF6B8B]/90 transition flex items-center justify-center whitespace-nowrap">
                            <i class="ri-share-line mr-2"></i> Partager
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h2 class="font-['Pacifico'] text-2xl mb-2">AnimeQuiz</h2>
                    <p class="text-gray-400">Le meilleur site de quiz sur les animes et mangas</p>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 flex items-center justify-center bg-gray-800 rounded-full hover:bg-[#6C63FF] transition">
                        <i class="ri-twitter-x-line"></i>
                    </a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center bg-gray-800 rounded-full hover:bg-[#6C63FF] transition">
                        <i class="ri-instagram-line"></i>
                    </a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center bg-gray-800 rounded-full hover:bg-[#6C63FF] transition">
                        <i class="ri-discord-line"></i>
                    </a>
                </div>
            </div>
            <div class="mt-8 pt-6 border-t border-gray-800 text-center text-gray-400">
                <p>© 2025 AnimeQuiz - Tous droits réservés</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const questions = document.querySelectorAll('.question-block');
            const totalQuestions = questions.length;
            let currentQuestionIndex = 0;
            let score = 0;
            const progressBar = document.getElementById('progress-bar');
            const currentQuestionElement = document.getElementById('current-question');
            const currentScoreElement = document.getElementById('current-score');
            const finalScoreElement = document.getElementById('final-score');
            const finalMessageElement = document.getElementById('final-message');
            
            // Initialiser la première question
            questions[0].classList.add('active');
            questions[0].classList.remove('hidden');
            updateProgressBar();

            // Ajouter les écouteurs d'événements pour les réponses
            document.querySelectorAll('.reponse').forEach(button => {
                button.addEventListener('click', handleAnswer);
            });

            function handleAnswer(event) {
                const button = event.currentTarget;
                const questionBlock = button.closest('.question-block');
                const correctAnswer = questionBlock.dataset.correct;
                const selectedAnswer = button.dataset.reponse;
                const isCorrect = selectedAnswer === correctAnswer;
                
                // Désactiver tous les boutons de cette question
                questionBlock.querySelectorAll('.reponse').forEach(btn => {
                    btn.disabled = true;
                    
                    // Marquer la réponse correcte
                    if (btn.dataset.reponse === correctAnswer) {
                        btn.classList.add('correct');
                    } 
                    // Marquer la réponse incorrecte sélectionnée
                    else if (btn.dataset.reponse === selectedAnswer && !isCorrect) {
                        btn.classList.add('incorrect');
                    }
                });

                // Mettre à jour le score
                if (isCorrect) {
                    score++;
                    currentScoreElement.textContent = score;
                    
                    // Afficher un message de feedback positif
                    const feedbackMessage = questionBlock.querySelector('.feedback-message');
                    feedbackMessage.textContent = "Correct! Bien joué!";
                    feedbackMessage.classList.add('bg-green-100', 'text-green-800', 'border', 'border-green-200');
                    feedbackMessage.classList.remove('hidden');
                } else {
                    // Afficher un message de feedback négatif
                    const feedbackMessage = questionBlock.querySelector('.feedback-message');
                    feedbackMessage.textContent = `Incorrect! La bonne réponse était: ${correctAnswer}`;
                    feedbackMessage.classList.add('bg-red-100', 'text-red-800', 'border', 'border-red-200');
                    feedbackMessage.classList.remove('hidden');
                }

                setTimeout(() => {
                    if (currentQuestionIndex < totalQuestions - 1) {
                        questions[currentQuestionIndex].classList.remove('active');
                        questions[currentQuestionIndex].classList.add('hidden');
                        currentQuestionIndex++;
                        questions[currentQuestionIndex].classList.remove('hidden');
                        setTimeout(() => {
                            questions[currentQuestionIndex].classList.add('active');
                        }, 50);
                        currentQuestionElement.textContent = currentQuestionIndex + 1;
                        updateProgressBar();
                    } else {
                        questions[currentQuestionIndex].classList.remove('active');
                        questions[currentQuestionIndex].classList.add('hidden');
                        finalScoreElement.textContent = score;
                        finalMessageElement.classList.remove('hidden');
                        createConfetti();
                    }
                }, 1500);
            }

            function updateProgressBar() {
                const progress = ((currentQuestionIndex)/ totalQuestions) * 100;
                progressBar.style.width = `${progress}%`;
            }

            function createConfetti() {
                const confettiContainer = document.querySelector('.confetti-container');
                const colors = ['#6C63FF', '#FF6B8B', '#FFD166', '#06D6A0', '#118AB2'];
                
                for (let i = 0; i < 50; i++) {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.setProperty('--color', colors[Math.floor(Math.random() * colors.length)]);
                    confetti.style.left = `${Math.random() * 100}%`;
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.animationDelay = `${Math.random() * 3}s`;
                    confettiContainer.appendChild(confetti);
                }
            }
        });
    </script>
</body>
</html>
