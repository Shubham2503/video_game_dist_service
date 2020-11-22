
let URL_API= 'https://api.themoviedb.org/3/list/15570?api_key=516adf1e1567058f8ecbf30bf2eb9378&language=en-US';
let movieList = [];
let i=0;
const card = document.querySelector('.content');
let ca = document.createElement('a');
let img = document.createElement('img');
const btnFlipHover = document.querySelector('#btnFlipHover');

function flipCard() {
  this.classList.toggle("flip");
}
var ctxL = document.getElementById("lineChart1").getContext('2d');
var myLineChart = new Chart(ctxL, {
  type: 'line',
  data: {
    labels: ["8 AM", "10 AM", "12 PM", "2 PM", "4 PM", "6 PM", "8 PM"],
    datasets: [{
      fill: false,
      borderColor: "#673ab7",
      pointBackgroundColor: "#673ab7",
      data: [885, 884, 887, 883, 888, 889, 888]
    }]
  },
  options: {
    responsive: false,
    legend: {
      display: false
    },
    elements: {
      line: {
        tension: 0.0
      }
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false,
        },
        ticks: {
          padding: 15,
          height: 30
        }
      }],
      yAxes: [{
        gridLines: {
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 5,
          padding: 15,
          min: 880,
          max: 890
        }
      }]
    }
  }
});


// btnFlipHover.addEventListener('click',async(e)=>{
  
  // e.preventDefault();
  // const allCards = document.querySelectorAll('.card');
  // allCards.forEach((card) => card.addEventListener("click", flipCard));
  
//const frontCardWebMobile = document.querySelector('.frontWeb');
  
  //frontCardWebMobile.classList.add("frontMobile"); 
  //frontCardWebMobile.classList.remove("frontWeb"); 
  
// });

//yy-mm-dd
// const getYearFromDate = (date) => {
//   let year= date.split('-').shift();
//   return year;
// };
// var genres_movies= '{ "genres": [ { "id": 28, "name": "Action" }, { "id": 12, "name": "Adventure" }, { "id": 16, "name": "Animation" }, { "id": 35, "name": "Comedy" }, { "id": 80, "name": "Crime" }, { "id": 99, "name": "Documentary" }, { "id": 18, "name": "Drama" }, { "id": 10751, "name": "Family" }, { "id": 14, "name": "Fantasy" }, { "id": 36, "name": "History" }, { "id": 27, "name": "Horror" }, { "id": 10402, "name": "Music" }, { "id": 9648, "name": "Mystery" }, { "id": 10749, "name": "Romance" }, { "id": 878, "name": "Science Fiction" }, { "id": 10770, "name": "TV Movie" }, { "id": 53, "name": "Thriller" }, { "id": 10752, "name": "War" }, { "id": 37, "name": "Western" } ] }';

// const getNameGensFormId = (idGen) => {
//   let genreName='';
//   let obj = JSON.parse(genres_movies);
//   for(let i=0;i<obj.genres.length;i++){
//     if(idGen==obj.genres[i].id ){
//       genreName=obj.genres[i].name;
//       break;
//     }
//   }
//   return genreName;
// };

// const getGenNames = (gensArrayIds) => {
//   let gensName='';
//   const sizeGenresArray = gensArrayIds.length;
//   for(let i=0;i<sizeGenresArray;i++){
//     gensName+=", "+getNameGensFormId( gensArrayIds[i] );
    
//   }
//   gensName = gensName.substr(1);
//   return gensName;
// };

// function mapCards(movies){
//   const html = movies.map(movie => {
//     let title = movie.title || movie.name;
//     let isMovieOrTv=(movie.title)?'movie':'tv';
//     return `
//       <div class="card" >
//         <div class="frontWeb" style="background-image: url(//image.tmdb.org/t/p/original${movie.poster_path});"> 
//           <p>${title}</p>
//         </div>

//         <div class="back">
//           <div>
//             <div class="release_date">${title} <span>(${getYearFromDate(movie.release_date)})</span></div>
//             <div class="movie_gens">${getGenNames(movie.genre_ids)}</div>
//             <div>⭐${movie.vote_average}</div>
            
//             <p class="overview">${movie.overview}</p>
//             <a target="_blank" href="https://www.themoviedb.org/${isMovieOrTv}/${movie.id}" class="button">Details</a>
//           </div>
//         </div>

//       </div>
//     `;
//   }).join('');
//   card.innerHTML= 
//     `<h1 class="heading">Movies</h1>`;
//   card.innerHTML+= html;
// }


// async function fetchMovies(urlEndpoint) {
//   let data;
//   try {
//     const response = await fetch(urlEndpoint);
//     data = await response.json();

//     //return (data);
//   } catch (error) {
//     console.log(error);
//   }
//   // return data.data;
//   return data.items || data.results;
// }

// (async () => {
//   const movies = await fetchMovies(URL_API);
//   mapCards(movies);
// })();