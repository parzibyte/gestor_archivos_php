module.exports = {
    // En realidad debería ser "./" pero al compilar se remueve el ./ así que mejor se pone doble para que solo
    // se remueva el primero. Gracias a: https://github.com/vuejs/vue-cli/issues/1623#issuecomment-729086789
    publicPath: process.env.NODE_ENV === 'production' ? '././' : './',
};