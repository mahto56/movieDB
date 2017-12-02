var mysql = require('mysql');
var request = require("request")
var http = require('http');
var fs = require('fs');

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

var movies = [];

function test(callback){
    query = db.query('SELECT * from movie',
        function(err, result) {
            // if(err) throw err;
            movies = result;
            callback(result);
            // console.log("");
            // console.log("movie inseted!");
        });
}


test((result)=>{
console.log('hello');
for(var entry of result){
    console.log(entry.mov_id+": "+entry.mov_title);
    request({
    url: "http://api.themoviedb.org/3/movie/"+entry.mov_id+"/credits?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb",
    json: true
    }, function (error, response, body) {

    if (!error && response.statusCode === 200) {
        // console.log(body.results[0]) // Print the json response
       let crews = body.crew;
        for(var crew of crews){
                if(crew.department=="Directing")
                {
                    let director = {
                    dir_id:crew.id,
                    dir_name:crew.name,
                };

                let mov_direction = {
                    dir_id:crew.id,
                    mov_id:body.id
                };

                // console.log(act);
                db.query('INSERT INTO director SET ?', director,
                    function(err, result) {
                        if(err) {console.log("director: "+director.dir_name+" already exist");}
                         // console.log(result);
                        if(result){console.log(director.dir_name+" inserted!");}
                    });

                db.query('INSERT INTO movie_direction SET ?', mov_direction,
                    function(err, result) {
                        if(err) {console.log("director: "+mov_direction.dir_id+" already exist!")}
                        // console.log(result);
                        console.log("director inseted!");
                    });
            }
    }
    }
})

}
});
