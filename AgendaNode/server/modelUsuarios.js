let mongoose = require('mongoose'),
Schema = mongoose.Schema,

// se difine el documento para usuarios
UserSchema = new Schema({
    user: {
        type: String,
        required: true,
        unique: true
    },
    email: {
        type: String,
        required: true    
    },
    password: {
        type: String,
        required: true    
    }
});

let UsarioModel = mongoose.model('Usuario', UserSchema)
module.exports = UsarioModel //exporta el documento