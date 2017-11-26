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
    url: "http://api.themoviedb.org/3/movie/"+entry.mov_id+"/casts?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb",
    json: true
    }, function (error, response, body) {

    if (!error && response.statusCode === 200) {
        // console.log(body.results[0]) // Print the json response
        actors = body.cast;
        for(var actor of actors){
                
                let act = {
                    act_id:actor.id,
                    act_name:actor.name,
                    act_gender:actor.gender
                };

                let mov_cast = {
                    act_id:actor.id,
                    mov_id:body.id,
                    role:actor.character
                };

                console.log(act);
                db.query('INSERT INTO actor SET ?', act,
                    function(err, result) {
                        if(err) {console.log("actor: "+act.act_name+" already exist");}
                         // console.log(result);
                        if(result){console.log(act.act_name+" inserted!");}
                    });

                db.query('INSERT INTO movie_cast SET ?', mov_cast,
                    function(err, result) {
                        if(err) {console.log("character: "+mov_cast.role+" already exist!")}
                        // console.log(result);
                        console.log("cast inseted!");
                    });
            
    }
    }
})

}
});

// for(var i=0;i<movies.length;i++){ 
// var url = "https://api.themoviedb.org/3/search/movie?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb&query="+movies[i];

// request({
//     url: url,
//     json: true
// }, function (error, response, body) {

//     if (!error && response.statusCode === 200) {
//         console.log(body.results[0]) // Print the json response
//         data = body.results[0];
//         poster = "http://image.tmdb.org/t/p/w500"+data.poster_path;
//         download(poster,'../assets/images/'+data.id+'.jpg');
//         run(data);    
//     }
// })


// function run(data){
//     var movie = {
//     mov_id: data.id,
//     mov_title: data.title,
//     mov_time: '120',
//     mov_lang: data.original_language,
//     mov_dt_rel:data.release_date,
//     mov_rel_country:data.Country,
//     mov_plot:data.overview
// }
// console.log(movie);   

// query = db.query('INSERT INTO movie SET ?', movie,
//     function(err, result) {
//         if(err) throw err;
//         console.log(result);
//         console.log("movie inseted!");
//     });

// for(var i=0;i<data.genre_ids.length;i++){
//         var genre = {
//             mov_id:data.id,
//             gen_id:data.genre_ids[i]
//         }
//         query = db.query('INSERT INTO movie_genres SET ?', genre,
//         function(err, result) {
//         if(err) throw  err;    
//         console.log(result);
//     });

// }

// var rating = {
//     mov_id:data.id,
//     rev_stars:data.vote_average
// }

// query = db.query('INSERT INTO rating SET ?', rating,
//         function(err, result) {
//         if(err) throw  err;    
//         console.log(result);
//     });

// console.log('done');

// }

// }



 


//  var query = db.query('INSERT INTO movie SET ?', movie,
//      function(err, result) {
//          console.log(result);
//      });
 

// var genre = [{"gen_id":28,"gen_title":"Action"},{"gen_id":12,"gen_title":"Adventure"},{"gen_id":16,"gen_title":"Animation"},{"gen_id":35,"gen_title":"Comedy"},{"gen_id":80,"gen_title":"Crime"},{"gen_id":99,"gen_title":"Documentary"},{"gen_id":18,"gen_title":"Drama"},{"gen_id":10751,"gen_title":"Family"},{"gen_id":14,"gen_title":"Fantasy"},{"gen_id":36,"gen_title":"History"},{"gen_id":27,"gen_title":"Horror"},{"gen_id":10402,"gen_title":"Music"},{"gen_id":9648,"gen_title":"Mystery"},{"gen_id":10749,"gen_title":"Romance"},{"gen_id":878,"gen_title":"Science Fiction"},{"gen_id":10770,"gen_title":"TV Movie"},{"gen_id":53,"gen_title":"Thriller"},{"gen_id":10752,"gen_title":"War"},{"gen_id":37,"gen_title":"Western"}]

// for(let i=0;i<genre.length;i++){
//     console.log("inserting: "+JSON.stringify(genre[i]));
//      query = db.query('INSERT INTO genres SET ?',genre[i] ,
//          function(err, result) {
//              console.log(result);
//      });
//  }


 
