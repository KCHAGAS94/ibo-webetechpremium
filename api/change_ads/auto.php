<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full-Screen Movie Banner</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            height: 100vh;
            background-color: #222;
            backdrop-filter: blur(0px); 
            background-repeat: no-repeat;
            background-size: cover; 
            position: relative;
            overflow: hidden; 
        }
        #movie-container {
            opacity: 0; 
            transition: opacity 0.2s ease-in-out; 
        }
        .movie-banner {
            display: flex;
            flex-direction: column;
            justify-content: space-between; 
            align-items: flex-start; 
            color: #fff;
            padding-left: 0; 
            position: relative;
            z-index: 2; 
            height: 100%;
        }

        #movie-poster-container {
            position: relative;
            width: auto;
            max-height: 100%; 
        }

        #movie-poster {
            width: 100%;
            height: 100%; 
            -webkit-mask-image: -webkit-gradient(linear, right top, left top, from(rgba(0,0,0,0)), to(rgba(0,0,0,1))); 
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(0, 0, 0, 1), transparent);
            z-index: 1; 
        }
        
         .info-container {
            position: fixed;
            top: 1.7vw;
            right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            color: white;
            font-size: 1.25vw;
        }
   
        .movie-info {
            position: fixed;
            top: 1.5vw;
            right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            color: white;
            font-size:2.6vw;
        }
        .subtitial-info{
            position: fixed;
            top: 0vw;
            right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            color: white;
            font-size:1.5vw;
        }
        
        .ratingbar-location {
            position: fixed;
            top: 6vw;
            right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            color: white;
            font-size:15px;
        }
       
        

    </style>

</head>
<body>
    <div class="movie-container" id="movie-container">
        <div class="overlay" id="viewport_capture">
            <div class="movie-banner">
                <div id="movie-poster-container">
                    
                </div>
            </div>
            <div class="info-container">
                <h1 id="movie-title" class="movie-info"></h1>
                <p id="msubtitial" class="subtitial-info"></p>
                <rating-bar class="ratingbar-location" id="rating-rtx"></rating-bar>
            </div>
        </div>
    </div>

    <script>
        const apiKey = '042ca3561d20c34adcc98489df9cc4b2'; // Replace with your TMDb API key
        let currentIndex = 0;
        let currentPage = 1; // Start with page 1
        let totalPageCount = 15;
        let movieIds = []; // Array to store movie IDs
        let nextImage = null; // Variable to store the next image

        // Function to fetch popular movie IDs for this week from TMDb API
        async function fetchPopularMovieIds() {
            while (currentPage <= totalPageCount) {
                try {
                    const response = await fetch(`https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&page=${currentPage}&sort_by=popularity.desc&language=pt-BR`);
                    const data = await response.json();
                    movieIds = [...movieIds, ...data.results.map(movie => movie.id)];
                    currentPage++; 
                } catch (error) {
                    console.error(error);
                    break; 
                }
            }
        }

        // Function to preload the next image
        function preloadNextImage() {
            if (movieIds.length === 0) {
                console.error('Falha ao obter IDs dos filmes.');
                return;
            }

            const nextIndex = (currentIndex + 1) % movieIds.length;
            const nextMovieId = movieIds[nextIndex];

            fetch(`https://api.themoviedb.org/3/movie/${nextMovieId}?api_key=${apiKey}&language=pt-BR`)
                .then((response) => response.json())
                .then((data) => {
                    nextImage = new Image();
                    nextImage.src = `https://image.tmdb.org/t/p/original${data.backdrop_path}`;
                })
                .catch((error) => console.error(error));
        }

        // Function to update movie information
        async function updateMovieInfo() {
            if (movieIds.length === 0) {
                console.error('Falha ao obter IDs dos filmes.');
                return;
            }

            const movieId = movieIds[currentIndex];

            fetch(`https://api.themoviedb.org/3/movie/${movieId}?api_key=${apiKey}&language=pt-BR`)
                .then((response) => response.json())
                .then((data) => {
                    const movieContainer = document.getElementById('movie-container');
                    const moviePoster = document.getElementById('movie-poster');
                    const movieTitle = document.getElementById('movie-title');
                    const mcategory = document.getElementById('msubtitial');
                    const rtxratingbar = document.getElementById('rating-rtx');

                    const releaseDate_full = data.release_date;
                    const genresArray = data.genres.map(genre => `🎬 ${genre.name}`).join(' ');
                    const origin_country = data.production_companies.map(production_companies => `${production_companies.origin_country}`).join(' ');
                    const duration = data.runtime;
                    const hours = Math.floor(duration / 60) + 'h';
                    const minutes = duration % 60 + 'm';
                    const fullSubtitial = ` 📀 ` + releaseDate_full + ` (${origin_country}) ` + ` | ` + genresArray + ` | ` + '🕝 ' + hours + ' ' + minutes;
                    mcategory.innerText = fullSubtitial;

                    const mrating = data.vote_average;
                    rtxratingbar.setAttribute("value", mrating);

                    const posterPath = `https://image.tmdb.org/t/p/original${data.backdrop_path}`;
                    document.body.style.backgroundImage = `url('${posterPath}')`;

                    const releaseDate = data.release_date;
                    const releaseYear = new Date(releaseDate).getFullYear();
                    var maintital = data.title + ` (`+releaseYear+`)`;
                    
                    if(maintital.length > 45){
                        movieTitle.classList.remove('movie-info-larger-forty');
                        movieTitle.classList.remove('movie-info-larger-thertyfive');
                        movieTitle.classList.remove('movie-info-larger');
                        movieTitle.classList.remove('movie-info-twoventryfive');
                        movieTitle.classList.remove('movie-info');
                        
                         movieTitle.classList.add("movie-info-larger-fortyfive");
                    }else if (maintital.length > 40){
                        movieTitle.classList.remove('movie-info-larger-thertyfive');
                        movieTitle.classList.remove('movie-info-larger');
                        movieTitle.classList.remove('movie-info-twoventryfive');
                        movieTitle.classList.remove('movie-info');
                        movieTitle.classList.remove("movie-info-larger-fortyfive");
                        movieTitle.classList.add("movie-info-larger-forty");
                    }else if (maintital.length > 35){
                        movieTitle.classList.remove('movie-info-larger-forty');
                        movieTitle.classList.remove('movie-info-larger');
                        movieTitle.classList.remove('movie-info-twoventryfive');
                        movieTitle.classList.remove('movie-info');
                        movieTitle.classList.remove("movie-info-larger-fortyfive");
                        movieTitle.classList.add("movie-info-larger-thertyfive");
                    }else if (maintital.length > 30){
                        movieTitle.classList.remove('movie-info-larger-forty');
                        movieTitle.classList.remove('movie-info-larger-thertyfive');
                        movieTitle.classList.remove('movie-info-twoventryfive');
                        movieTitle.classList.remove('movie-info');
                        movieTitle.classList.remove("movie-info-larger-fortyfive");
                        movieTitle.classList.add("movie-info-larger");
                    }else if (maintital.length >= 25){
                        movieTitle.classList.remove('movie-info-larger-forty');
                        movieTitle.classList.remove('movie-info-larger-thertyfive');
                        movieTitle.classList.remove('movie-info-larger');
                        movieTitle.classList.remove('movie-info');
                        movieTitle.classList.remove("movie-info-larger-fortyfive");
                        movieTitle.classList.add("movie-info-twoventryfive");
                    }else{
                        movieTitle.classList.remove('movie-info-larger-forty');
                        movieTitle.classList.remove('movie-info-larger-thertyfive');
                        movieTitle.classList.remove('movie-info-larger');
                        movieTitle.classList.remove('movie-info-twoventryfive');
                        movieTitle.classList.remove("movie-info-larger-fortyfive");
                        movieTitle.classList.add("movie-info");
                    }
                    movieTitle.innerText = maintital;

                    movieContainer.style.opacity = 1;
                })
                .catch((error) => console.error(error));

            currentIndex = (currentIndex + 1) % movieIds.length; // Increment index in a loop
            preloadNextImage(); // Preload the next image after updating the current movie
        }

        // Call the fetchPopularMovieIds function initially
        fetchPopularMovieIds().then(() => {
            preloadNextImage(); // Preload the first image
            setTimeout(updateMovieInfo, 2000); // Set an initial timeout for the first update
            setInterval(updateMovieInfo, 9000); // Set the interval for subsequent updates
        });
    </script>
    
    <script>  
      customElements.define("rating-bar", class RatingBar extends HTMLElement {   
        constructor() {
          super();      
          this.attachShadow({ mode: "open" });
        }
        
        static get observedAttributes() {
          return ["value"];
        }
     
        attributeChangedCallback(name, old, current) {
          this[name] = Number(current ?? 1);
          this.render();
        }
    
    showStars(selector) {
      const stars = [];
      
      const wholeStars = Math.floor(this.value);
      const fractionalStar = this.value - wholeStars;
    
      for (let i = 0; i < this.maxValue; i++) {
        const star = document.createElement("span");
        star.textContent = "⭐";
        star.addEventListener("click", () => this.select(i));
        if (i < wholeStars) {
          star.classList.add("full");
        } else if (i === wholeStars) {
          star.classList.add("partial");
          star.style.width = `${fractionalStar * 100}%`;
        } else {
          // Empty star for the rest
          star.classList.add("off");
        }
        stars.push(star);
      }
  
          const parent = this.shadowRoot.querySelector(selector);
          stars.forEach(star => parent.appendChild(star));
          const text = document.createElement("span");
          
          if (this.value === Math.floor(this.value)) {
            text.textContent = `(${this.value})`;
          } else {
            text.textContent = `(${this.value.toFixed(1)})`;
          }
          
          parent.appendChild(text);
        }

    select(num) {
      console.log("Select ", num);
      this.value = num;
      this.render();
    }
  
    connectedCallback() {
      this.maxValue = Number(this.getAttribute("max-value") ?? 10);      
      this.value = Number(this.getAttribute("value") ?? 0);
      this.render();
    }
    
    render() {
      this.shadowRoot.innerHTML = `
        <style>
          span { font-size: 15px; 
          color: white;
          }
          .off { filter: grayscale(1); }
          span:hover {
            filter: hue-rotate(160deg);
            cursor: pointer;
          }
        </style>
        <div class="rating"></div>
      `;
      this.showStars(".rating");
    }
  });
  
</script>

</body>
</html>
