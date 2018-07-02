let mongoose = require('mongoose'),
Schema = mongoose.Schema,

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
module.exports = UsarioModel