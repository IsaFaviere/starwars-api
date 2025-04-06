<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorador da API Star Wars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('https://lumiere-a.akamaihd.net/v1/images/image_1921b77b.jpeg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            font-family: 'Orbitron', sans-serif;
            padding: 20px;
            margin: 0;
        }
        .container {
            background: rgba(0, 0, 0, 0.85);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
            min-height: 80vh;
            position: relative;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 300px;
        }
        h1 {
            color: #ffd700;
            text-shadow: 0 0 10px #ffd700;
            text-align: center;
            margin-bottom: 30px;
            animation: crawl 10s linear;
        }
        .form-control {
            background: #1a1a1a;
            border: 2px solid #00ccff;
            color: #fff;
            font-size: 1.1rem;
        }
        .form-control:focus {
            border-color: #ff3333;
            box-shadow: 0 0 10px #ff3333;
        }
        .btn-primary {
            background: #ffd700;
            border: none;
            color: #000;
            font-weight: bold;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background: #00ccff;
            color: #fff;
            box-shadow: 0 0 15px #00ccff;
        }
        .card {
            background: rgba(30, 30, 30, 0.9);
            border: 1px solid #ffd700;
            margin-bottom: 20px;
            transition: transform 0.3s;
            position: relative;
            padding-left: 40px;
        }
        .card::before {
            content: '⚔️';
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px #ffd700;
        }
        .card-title {
            color: #00ccff;
            text-shadow: 0 0 5px #00ccff;
        }
        .btn-info {
            background: #ff3333;
            border: none;
            color: #fff;
        }
        .btn-info:hover {
            background: #ffd700;
            color: #000;
            box-shadow: 0 0 10px #ffd700;
        }
        footer {
            text-align: center;
            margin-top: 30px;
            padding: 10px;
            background: rgba(0, 0, 0, 0.9);
            border-top: 1px solid #ffd700;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        footer p {
            margin: 0;
            font-size: 0.9rem;
        }
        footer a {
            color: #00ccff;
            text-decoration: none;
        }
        footer a:hover {
            color: #ffd700;
        }
        @keyframes crawl {
            0% {
                transform: perspective(500px) rotateX(25deg) translateY(100%);
                opacity: 0;
            }
            100% {
                transform: perspective(500px) rotateX(0deg) translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6c/Star_Wars_Logo.svg" alt="Star Wars Logo" class="logo">

        <h1>Explorador da API Star Wars</h1>
        
        <!-- cmpo pra busca -->
        <div class="mb-3">
            <input type="text" id="search" class="form-control" placeholder="Busque um filme (ex.: Empire)">
            <button class="btn btn-primary mt-2" onclick="playLightsaberSound(); searchFilms()">Explorar a Galáxia</button>
        </div>

        <!-- resultados -->
        <div id="results" class="row"></div>

        <!-- Footer temático -->
        <footer>
            <p>"Que a Força esteja com você." – Obi-Wan Kenobi</p>
            <p>Powered by <a href="https://swapi.dev/" target="_blank">SWAPI</a></p>
        </footer>
    </div>

    <!-- SPOILER: Han Solo é congelado em carbonita em 'O Império Contra-Ataca' -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Função pra tocar o som de sabre de luz ~Se Deus quiser da certo
        function playLightsaberSound() {
            const audio = new Audio('/sounds/lightsaber.mp3');
            audio.play();
        }

        async function searchFilms() {
            const searchTerm = document.getElementById('search').value;
            const response = await fetch(`/api/films?search=${searchTerm}`);
            const films = await response.json();

            const resultsDiv = document.getElementById('results');
            resultsDiv.innerHTML = '';

            films.forEach(film => {
                const filmId = film.url.split('/')[5];
                resultsDiv.innerHTML += `
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${film.title}</h5>
                                <button class="btn btn-info" onclick="getCharacters(${filmId})">
                                    Revelar Personagens
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            });
        }

        async function getCharacters(filmId) {
            const response = await fetch(`/api/films/${filmId}/characters`);
            const data = await response.json();

            alert(`Filme: ${data.title}\nPersonagens: ${data.characters.join(', ')}`);
        }
    </script>
</body>
</html>