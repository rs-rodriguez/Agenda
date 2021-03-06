let mongoose = require('mongoose'),
Schema = mongoose.Schema,

// se difine el documento donde se guardara la informacion de eventos
EventSchema = new Schema({
    title:{
        type:String,
        required: true
    },
    start:{
        type:String,
        required: true
    },
    end:{
        type:String,
        required: true
    },
    user:{
        type:Schema.Types.ObjectId,
        required: true
    }
});

let EventoModel = mongoose.model('Evento', EventSchema)
module.exports = EventoModel // se exporta el modelo