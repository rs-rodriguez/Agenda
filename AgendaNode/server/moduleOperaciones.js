var usuario = require('./modelUsuarios')

// aca se generea el usuario demo
module.exports.crearDemoUsuario = function(callback){
    var data = [
        {
            email: 'demo@mail.com',
            user: "demo",
            password: "123456"
        },
        { 
            email: 'juan@mail.com',
            user: "juan",
            password: "123456"
        }
    ]
    // funcion que permite guardar multiples datos
    usuario.insertMany(data, function(error, docs){
        if (error){
            if (error.code == 11000){
              callback("Utilice los siguientes datos: </br>usuario: demo | password:123456 </br>usuario: juan | password:123456")
            }else{
              callback(error.message)
            }
          }else{
            callback(null, "El usuario 'demo' y 'juan' se ha registrado correctamente. </br>usuario: demo | password:123456 </br >usuario: juan | password:123456")
          }
    })
}