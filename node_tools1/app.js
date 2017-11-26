var mysql = require('mysql');
var request = require("request")
var http = require('http');
var fs = require('fs');

var download = function(url, dest, cb) {
  var file = fs.createWriteStream(dest);
  var request = http.get(url, function(response) {
    response.pipe(file);
    file.on('finish', function() {
      file.close(cb);  // close() is async, call cb after close completes.
    });
  }).on('error', function(err) { // Handle errors
    fs.unlink(dest); // Delete the file async. (But we don't check the result)
    if (cb) cb(err.message);
  });
};
var db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'movies',
    debug: false,
});

db.connect(function(err){
    if(err){
        console.log("error connecting!")
        throw err;
    }
    console.log("Connected to MySQL !");
});


// var data = {
// "vote_count": 6347,
// "id": 238,
// "video": false,
// "vote_average": 8.5,
// "title": "The Godfather",
// "popularity": 64.764419,
// "poster_path": "/rPdtLWNsZmAtoZl9PK7S2wE3qiS.jpg",
// "original_language": "en",
// "original_title": "The Godfather",
// "genre_ids": [
// 18,
// 80
// ],
// "backdrop_path": "/6xKCYgH16UuwEGAyroLU6p8HLIn.jpg",
// "adult": false,
// "overview": "Spanning the years 1945 to 1955, a chronicle of the fictional Italian-American Corleone crime family. When organized crime family patriarch, Vito Corleone barely survives an attempt on his life, his youngest son, Michael steps in to take care of the would-be killers, launching a campaign of bloody revenge.",
// "release_date": "1972-03-14"
// } 

movies = ["Snow+White"]

for(var i=0;i<movies.length;i++){ 
var url = "https://api.themoviedb.org/3/search/movie?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb&query="+movies[i];

request({
    url: url,
    json: true
}, function (error, response, body) {

    if (!error && response.statusCode === 200) {
        console.log(body.results[0]) // Print the json response
        data = body.results[0];
        poster = "http://image.tmdb.org/t/p/w500"+data.poster_path;
        download(poster,'../assets/images/'+data.id+'.jpg');
        run(data);    
    }
})


function run(data){
    var movie = {
    mov_id: data.id,
    mov_title: data.title,
    mov_time: '120',
    mov_lang: data.original_language,
    mov_dt_rel:data.release_date,
    mov_rel_country:data.Country,
    mov_plot:data.overview
}
console.log(movie);   

query = db.query('INSERT INTO movie SET ?', movie,
    function(err, result) {
        if(err) throw err;
        console.log(result);
        console.log("movie inseted!");
    });

for(var i=0;i<data.genre_ids.length;i++){
        var genre = {
            mov_id:data.id,
            gen_id:data.genre_ids[i]
        }
        query = db.query('INSERT INTO movie_genres SET ?', genre,
        function(err, result) {
        if(err) throw  err;    
        console.log(result);
    });

}

var rating = {
    mov_id:data.id,
    rev_stars:data.vote_average
}

query = db.query('INSERT INTO rating SET ?', rating,
        function(err, result) {
        if(err) throw  err;    
        console.log(result);
    });

console.log('done');

}

}



 


